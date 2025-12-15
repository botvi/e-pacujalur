<?php

namespace App\Exports;

use App\Models\UndianPacu;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;

class UndianPacuExport implements FromArray, WithHeadings, WithTitle
{
    protected UndianPacu $undianPacu;
    /** @var \Illuminate\Support\Collection<int, \App\Models\Jalur> */
    protected Collection $jalur;

    /**
     * @param  UndianPacu  $undianPacu
     * @param  Collection  $jalur   // collection keyed by id
     */
    public function __construct(UndianPacu $undianPacu, Collection $jalur)
    {
        $this->undianPacu = $undianPacu;
        $this->jalur = $jalur;
    }

    public function headings(): array
    {
        return [
            'No',
            'Event',
            'Gelanggang',
            'Tanggal',
            'Jam',
            'Tipe Baris', // Pair / Bay
            'Jalur Kiri',
            'Jalur Kanan / Bay',
        ];
    }

    public function array(): array
    {
        $data = [];

        $participants = is_array($this->undianPacu->participants)
            ? $this->undianPacu->participants
            : (json_decode($this->undianPacu->participants, true) ?? []);

        $pairing = $participants['pairing'] ?? [];
        if (!is_array($pairing)) {
            $pairing = [];
        }

        $eventName = optional($this->undianPacu->event)->nama_event;
        $gelanggangName = optional($this->undianPacu->gelanggang)->nama_gelanggang;
        $tanggal = $this->undianPacu->tanggal;
        $jam = $this->undianPacu->jam;

        $rowNo = 1;
        foreach ($pairing as $p) {
            if (isset($p['kiri']) && isset($p['kanan'])) {
                $kiriJ = $this->jalur->get($p['kiri']);
                $kananJ = $this->jalur->get($p['kanan']);

                $data[] = [
                    $rowNo++,
                    $eventName,
                    $gelanggangName,
                    $tanggal,
                    $jam,
                    'Pair',
                    $kiriJ?->nama_jalur ?? ('ID '.$p['kiri']),
                    $kananJ?->nama_jalur ?? ('ID '.$p['kanan']),
                ];
            } elseif (isset($p['bay'])) {
                $bayJ = $this->jalur->get($p['bay']);

                $data[] = [
                    $rowNo++,
                    $eventName,
                    $gelanggangName,
                    $tanggal,
                    $jam,
                    'Bay',
                    '-',
                    $bayJ?->nama_jalur ?? ('ID '.$p['bay']),
                ];
            }
        }

        if (empty($data)) {
            $data[] = [
                1,
                $eventName,
                $gelanggangName,
                $tanggal,
                $jam,
                'Info',
                'Belum ada hasil undian jalur',
                '',
            ];
        }

        return $data;
    }

    public function title(): string
    {
        return 'Undian Pacu';
    }
}
