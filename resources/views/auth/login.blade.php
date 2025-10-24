<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>e-PacuJalur - Login</title>

  <!-- favicon -->
  <link rel="shortcut icon" href="{{ asset('env') }}/logo.png" type="image/x-icon">

  <!-- custom css link -->
  <link rel="stylesheet" href="{{ asset('linkskuy') }}/assets/css/style.css">
  <link rel="stylesheet" href="{{ asset('linkskuy') }}/assets/css/authstyle.css">
  
  <style>
    body {
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
      min-height: 100vh;
      font-family: 'Poppins', sans-serif;
    }
    
    .login-container {
      display: flex;
      justify-content: center;
      align-items: center;
      min-height: 100vh;
      padding: 20px;
    }
    
    .login-form-container {
      background: rgba(255, 255, 255, 0.95);
      backdrop-filter: blur(10px);
      border-radius: 20px;
      box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
      padding: 40px;
      width: 100%;
      max-width: 400px;
      border: 1px solid rgba(255, 255, 255, 0.2);
    }
    
    .form-header {
      text-align: center;
      margin-bottom: 30px;
    }
    
    .form-title {
      color: #2d3748;
      font-size: 28px;
      font-weight: 700;
      margin-bottom: 8px;
      background: linear-gradient(135deg, #667eea, #764ba2);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      background-clip: text;
    }
    
    .form-subtitle {
      color: #718096;
      font-size: 16px;
      margin: 0;
    }
    
    .form-group {
      margin-bottom: 20px;
    }
    
    .form-label {
      display: flex;
      align-items: center;
      color: #4a5568;
      font-weight: 500;
      margin-bottom: 8px;
      font-size: 14px;
    }
    
    .form-label ion-icon {
      margin-right: 8px;
      font-size: 18px;
      color: #667eea;
    }
    
    .form-input {
      width: 100%;
      padding: 12px 16px;
      border: 2px solid #e2e8f0;
      border-radius: 12px;
      font-size: 16px;
      transition: all 0.3s ease;
      background: rgba(255, 255, 255, 0.8);
    }
    
    .form-input:focus {
      outline: none;
      border-color: #667eea;
      box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
      background: white;
    }
    
    .password-input-group {
      position: relative;
    }
    
    .password-toggle {
      position: absolute;
      right: 12px;
      top: 50%;
      transform: translateY(-50%);
      background: none;
      border: none;
      color: #718096;
      cursor: pointer;
      font-size: 18px;
      transition: color 0.3s ease;
    }
    
    .password-toggle:hover {
      color: #667eea;
    }
    
    .form-options {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 25px;
    }
    
    .checkbox-container {
      display: flex;
      align-items: center;
      cursor: pointer;
      color: #4a5568;
      font-size: 14px;
    }
    
    .checkbox-container input[type="checkbox"] {
      margin-right: 8px;
      accent-color: #667eea;
    }
    
    .button-custom-shine {
      width: 100%;
      padding: 14px 20px;
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
      color: white;
      border: none;
      border-radius: 12px;
      font-size: 16px;
      font-weight: 600;
      cursor: pointer;
      transition: all 0.3s ease;
      box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
      position: relative;
      overflow: hidden;
    }
    
    .button-custom-shine:hover {
      transform: translateY(-2px);
      box-shadow: 0 8px 25px rgba(102, 126, 234, 0.4);
    }
    
    .button-custom-shine:active {
      transform: translateY(0);
    }
    
    .button-custom-shine::before {
      content: '';
      position: absolute;
      top: 0;
      left: -100%;
      width: 100%;
      height: 100%;
      background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
      transition: left 0.5s;
    }
    
    .button-custom-shine:hover::before {
      left: 100%;
    }
    
    .error-message {
      color: #e53e3e;
      font-size: 12px;
      margin-top: 5px;
      display: block;
      font-weight: 500;
    }
    
    .is-invalid {
      border-color: #e53e3e !important;
      box-shadow: 0 0 0 3px rgba(229, 62, 62, 0.1) !important;
    }
    
    .alert {
      margin-bottom: 20px;
      padding: 12px 16px;
      border-radius: 8px;
      font-size: 14px;
    }
    
    .alert-danger {
      background-color: #fed7d7;
      border: 1px solid #feb2b2;
      color: #c53030;
    }
    
    .alert ul {
      margin: 0;
      padding-left: 20px;
    }
    
    .alert li {
      margin-bottom: 4px;
    }
    
    /* Responsive */
    @media (max-width: 480px) {
      .login-form-container {
        padding: 30px 20px;
        margin: 10px;
      }
      
      .form-title {
        font-size: 24px;
      }
    }
    
    /* Animation */
    @keyframes fadeInUp {
      from {
        opacity: 0;
        transform: translateY(30px);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }
    
    @keyframes float {
      0%, 100% {
        transform: translateY(0px) rotate(0deg);
      }
      50% {
        transform: translateY(-20px) rotate(180deg);
      }
    }
    
    @keyframes pulse {
      0%, 100% {
        transform: scale(1);
      }
      50% {
        transform: scale(1.05);
      }
    }
    
    .login-form-container {
      animation: fadeInUp 0.6s ease-out;
    }
    
    .form-header img {
      animation: pulse 2s ease-in-out infinite;
    }
    
    .form-input:focus {
      animation: pulse 0.3s ease-out;
    }
  </style>

  <!-- google font link -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>

<body>
  <!-- #MAIN -->
  <main>
    <!-- Background Decoration -->
    <div style="position: fixed; top: 0; left: 0; width: 100%; height: 100%; z-index: -1; overflow: hidden;">
      <div style="position: absolute; top: -50%; left: -50%; width: 200%; height: 200%; background: radial-gradient(circle, rgba(255,255,255,0.1) 1px, transparent 1px); background-size: 20px 20px; animation: float 20s ease-in-out infinite;"></div>
      <div style="position: absolute; top: 20%; right: 10%; width: 100px; height: 100px; background: rgba(255,255,255,0.1); border-radius: 50%; animation: float 15s ease-in-out infinite reverse;"></div>
      <div style="position: absolute; bottom: 20%; left: 10%; width: 60px; height: 60px; background: rgba(255,255,255,0.1); border-radius: 50%; animation: float 10s ease-in-out infinite;"></div>
    </div>
    
    <!-- Login Container -->
    <div class="login-container">
      <!-- Login Form -->
      <div class="login-form-container">
        <div class="form-header">
          <div style="text-align: center; margin-bottom: 20px;">
            <img src="{{ asset('env') }}/logo_text.png" alt="e-PacuJalur Logo" style="width: 100px; height: 100px; object-fit: contain; margin-bottom: 10px;">
          </div>
          <h2 class="form-title">Selamat Datang!</h2>
          <p class="form-subtitle">Masuk ke sistem e-PacuJalur</p>
        </div>

  

        <form method="POST" action="{{ route('login') }}" class="login-form">
          @csrf
          
          @if ($errors->any())
            <div class="alert alert-danger" style="background-color: #fee; border: 1px solid #fcc; color: #c33; padding: 10px; border-radius: 5px; margin-bottom: 20px;">
              <ul style="margin: 0; padding-left: 20px;">
                @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
                @endforeach
              </ul>
            </div>
          @endif
          
          <!-- Username Field -->
          <div class="form-group">
            <label for="username" class="form-label">
              <ion-icon name="person-outline"></ion-icon>
              Username atau Email
            </label>
            <input type="text" id="username" name="username" class="form-input @error('username') is-invalid @enderror"
              placeholder="Masukkan username atau email" value="{{ old('username') }}" required>
            @error('username')
              <small class="error-message">{{ $message }}</small>
            @enderror
          </div>

          <!-- Password Field -->
          <div class="form-group">
            <label for="password" class="form-label">
              <ion-icon name="lock-closed-outline"></ion-icon>
              Password
            </label>
            <div class="password-input-group">
              <input type="password" id="password" name="password" class="form-input @error('password') is-invalid @enderror" placeholder="Masukkan password"
                required>
              <button type="button" class="password-toggle" data-password-toggle
                aria-label="Toggle password visibility">
                <ion-icon name="eye-outline"></ion-icon>
              </button>
            </div>
            @error('password')
              <small class="error-message">{{ $message }}</small>
            @enderror
          </div>

          <!-- Remember Me & Forgot Password -->
          <div class="form-options">
            <label class="checkbox-container">
              <input type="checkbox" id="remember-me" name="remember-me">
              <span class="checkmark"></span>
              Ingat saya
            </label>
          </div>

          <!-- Login Button -->
          <button type="submit" class="button-custom-shine">
            <ion-icon name="log-in-outline" style="margin-right: 8px; font-size: 18px;"></ion-icon>
            Masuk ke e-PacuJalur
          </button>

      
        </form>
        
        <!-- Footer -->
        <div style="text-align: center; margin-top: 30px; padding-top: 20px; border-top: 1px solid rgba(0,0,0,0.1);">
          <p style="color: #718096; font-size: 12px; margin: 0;">
            © 2024 e-PacuJalur. Sistem Manajemen Publikasi Pacu Jalur Digital.
          </p>
          <p style="color: #a0aec0; font-size: 11px; margin: 5px 0 0 0;">
            Powered by Laravel Framework
          </p>
        </div>
      </div>
    </div>
  </main>

  <!-- custom js link -->
  <script src="{{ asset('linkskuy') }}/assets/js/auth.js"></script>
  @include('sweetalert::alert')
  <!-- ionicon link -->
  <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons/5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</html>