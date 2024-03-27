<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body {
            font-family: "DejaVu Sans";
        }
        .text-center {
            text-align: center
        }
    </style>
</head>
<body>
    <div>
        <div class="text-center ">
            <h1>CỘNG HÒA XÃ HỘI CHỦ NGHĨA VIỆT NAM</h1>
            <h2>Độc lập - Tự do - Hạnh phúc</h4>
        </div>
        <br>
        <h3 class="mt-3 text-center ">PHỤ LỤC GIA HẠN HỢP ĐỒNG THUÊ NHÀ</h3>
        <p>– Căn cứ theo Hợp đồng thuê nhà số:… đã ký ngày {{ $contract->started_at }}  (sau đây gọi tắt là “Hợp đồng”);</p>
        <p>– Căn cứ theo thỏa thuận của hai bên;</p>
        <p>Phụ lục Hợp Đồng này được lập và ký ngày {{ $extension_contract->started_at }}, có giá trị trong vòng {{ $extension_contract->month_quantity }} tháng kể từ ngày ký giữa các bên bao gồm:</p>
        <h4>BÊN A(BÊN CHO THUÊ): </h4>
        <p>Ông(bà): {{ $owner->name }}</p>
        <p>Số CCCD: {{ $owner->cccd }}</p>
        <p>HKTT: {{ $owner->address }}</p>
        <p>Số điện thoại: {{ $owner->phone }}</p>
        
        <h4>BÊN B(BÊN THUÊ NHÀ) gồm: </h4>
        <table border="1">
            <thead>
                <tr>
                    <th>Ông(bà)</th>
                    <th>Số điện thoại</th>
                    <th>Số căn cước công dân</th>
                    <th>Quê quán</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($members as $item)
                    <tr>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->phone }}</td>
                        <td>{{ $item->cccd }}</td>
                        <td>{{ $item->address }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <P>Cùng thỏa thuận giao kết với các nội dung sau đây: </P>
        <h4>ĐIỀU 1. NỘI DUNG</h4>
            {!! $extension_contract->description !!}
        <div style="margin-top: 20px;">
            <h4 style="float: left">Bên cho thuê</h4>
            <h4 style="float: right">Bên thuê</h4>
        </div>
    </div>
</body>
</html>