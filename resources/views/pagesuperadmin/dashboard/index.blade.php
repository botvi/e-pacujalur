@extends('template-admin.layout')

@section('content')
    <div class="pc-container">
        <div class="pc-content">
            <!-- [ breadcrumb ] start -->
            <div class="page-header">
                <div class="page-block">
                    <div class="row align-items-center">
                        <div class="col-md-12">
                            <div class="page-header-title">
                                <h5 class="m-b-10">Home</h5>
                            </div>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ asset('admin') }}/dashboard/index.html">Home</a></li>
                                <li class="breadcrumb-item"><a href="javascript: void(0)">Dashboard</a></li>
                                <li class="breadcrumb-item" aria-current="page">Home</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!-- [ breadcrumb ] end -->
            
            <!-- [ Main Content ] start -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-md-6">
                                    <div class="logo-section">
                                        <img src="{{ asset('env/logo.png') }}" alt="e-PacuJalur Logo" class="logo-img">
                                        <div class="logo-text">
                                            <h2 class="logo-title">e-PacuJalur</h2>
                                            <p class="logo-subtitle">Sistem Manajemen Pacu Jalur Digital</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="welcome-section">
                                        <h3 class="welcome-title">Selamat Datang di Dashboard</h3>
                                        <p class="welcome-description">
                                            Kelola dan pantau semua aktivitas pacu jalur dengan mudah melalui sistem e-PacuJalur. 
                                            Dapatkan informasi real-time tentang event, gelanggang, jalur, dan hasil pacu.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- [ Web Description ] start -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Tentang e-PacuJalur</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="web-description">
                                        <h4>Platform Digital untuk Pacu Jalur</h4>
                                        <p>
                                            e-PacuJalur adalah sistem manajemen digital yang dirancang khusus untuk mengelola 
                                            kegiatan pacu jalur secara terintegrasi. Platform ini memungkinkan pengelolaan 
                                            event, gelanggang, jalur pacu, dan hasil pertandingan dalam satu tempat.
                                        </p>
                                        
                                        <h5>Fitur Utama:</h5>
                                        <ul class="feature-list">
                                            <li><i class="fas fa-calendar-alt text-primary"></i> Manajemen Event Pacu Jalur</li>
                                            <li><i class="fas fa-map-marker-alt text-success"></i> Pengelolaan Gelanggang</li>
                                            <li><i class="fas fa-route text-info"></i> Manajemen Jalur Pacu</li>
                                            <li><i class="fas fa-trophy text-warning"></i> Sistem Pencatatan Hasil</li>
                                            <li><i class="fas fa-random text-danger"></i> Undian Pacu Digital</li>
                                            <li><i class="fas fa-chart-bar text-secondary"></i> Laporan dan Statistik</li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="stats-section">
                                        <h5>Statistik Sistem</h5>
                                        <div class="stat-item">
                                            <div class="stat-icon">
                                                <i class="fas fa-users"></i>
                                            </div>
                                            <div class="stat-content">
                                                <h6>Pengguna Aktif</h6>
                                                <span class="stat-number">{{ \App\Models\User::count() }}</span>
                                            </div>
                                        </div>
                                        <div class="stat-item">
                                            <div class="stat-icon">
                                                <i class="fas fa-calendar-check"></i>
                                            </div>
                                            <div class="stat-content">
                                                <h6>Event Aktif</h6>
                                                <span class="stat-number">{{ \App\Models\Event::count() }}</span>
                                            </div>
                                        </div>
                                        <div class="stat-item">
                                            <div class="stat-icon">
                                                <i class="fas fa-map-marked-alt"></i>
                                            </div>
                                            <div class="stat-content">
                                                <h6>Gelanggang</h6>
                                                <span class="stat-number">{{ \App\Models\Gelanggang::count() }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- [ Web Description ] end -->
         
        </div>
    </div>
@endsection

@section('style')
<style>
.logo-section {
    display: flex;
    align-items: center;
    gap: 20px;
    padding: 20px 0;
}

.logo-img {
    width: 80px;
    height: 80px;
    object-fit: contain;
    border-radius: 15px;
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
}

.logo-text {
    flex: 1;
}

.logo-title {
    font-size: 2.5rem;
    font-weight: 700;
    color: #2c3e50;
    margin-bottom: 5px;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

.logo-subtitle {
    font-size: 1.1rem;
    color: #6c757d;
    margin: 0;
    font-weight: 500;
}

.welcome-section {
    padding: 20px 0;
    text-align: right;
}

.welcome-title {
    font-size: 1.8rem;
    font-weight: 600;
    color: #2c3e50;
    margin-bottom: 15px;
}

.welcome-description {
    font-size: 1rem;
    color: #6c757d;
    line-height: 1.6;
    margin: 0;
}

.web-description h4 {
    color: #2c3e50;
    font-weight: 600;
    margin-bottom: 15px;
}

.web-description h5 {
    color: #495057;
    font-weight: 600;
    margin: 20px 0 10px 0;
}

.web-description p {
    color: #6c757d;
    line-height: 1.7;
    margin-bottom: 15px;
}

.feature-list {
    list-style: none;
    padding: 0;
    margin: 0;
}

.feature-list li {
    display: flex;
    align-items: center;
    margin-bottom: 10px;
    padding: 8px 0;
    font-size: 0.95rem;
    color: #495057;
}

.feature-list li i {
    margin-right: 12px;
    font-size: 1.1rem;
    width: 20px;
}

.stats-section {
    background: #f8f9fa;
    padding: 25px;
    border-radius: 10px;
    height: 100%;
}

.stats-section h5 {
    color: #2c3e50;
    font-weight: 600;
    margin-bottom: 20px;
    text-align: center;
}

.stat-item {
    display: flex;
    align-items: center;
    margin-bottom: 20px;
    padding: 15px;
    background: white;
    border-radius: 8px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.05);
    transition: transform 0.3s ease;
}

.stat-item:hover {
    transform: translateY(-2px);
}

.stat-icon {
    width: 50px;
    height: 50px;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-right: 15px;
    flex-shrink: 0;
}

.stat-icon i {
    color: white;
    font-size: 1.2rem;
}

.stat-content h6 {
    margin: 0 0 5px 0;
    color: #6c757d;
    font-size: 0.9rem;
    font-weight: 500;
}

.stat-number {
    font-size: 1.5rem;
    font-weight: 700;
    color: #2c3e50;
}

.card {
    border: none;
    box-shadow: 0 4px 20px rgba(0,0,0,0.08);
    border-radius: 15px;
    margin-bottom: 30px;
}

.card-header {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    border-radius: 15px 15px 0 0;
    border: none;
    padding: 20px 25px;
}

.card-title {
    margin: 0;
    font-weight: 600;
    font-size: 1.2rem;
}

@media (max-width: 768px) {
    .logo-section {
        flex-direction: column;
        text-align: center;
        gap: 15px;
    }
    
    .welcome-section {
        text-align: center;
        margin-top: 20px;
    }
    
    .logo-title {
        font-size: 2rem;
    }
    
    .welcome-title {
        font-size: 1.5rem;
    }
}
</style>
@endsection
