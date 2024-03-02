<div>
    <h2>Xin chào {{ $mailData['name'] }}.</h2>
    <p>Bạn đã đăng ký hệ thống website của chúng tôi.</p>
    <p>Để sử dụng được vui lòng kích hoạt toài khoản, bạn vui lòng nhấn vào link bên dưới.</p>
    <a href="{{ route('admin.active', ['admin' => $mailData['id'], 'token' => $mailData['token']]) }}">Kích hoạt tài khoản</a>
</div>