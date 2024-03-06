<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bill Template</title>
    <style>
        body {
            font-family: "DejaVu Sans", sans-serif;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }
        h1 {
            text-align: center;
            margin-bottom: 20px;
        }
        .item {
            margin-bottom: 20px;
        }
        .item p {
            margin: 5px 0;
        }
        .item hr {
            border: 0;
            border-top: 1px solid #ccc;
        }
        .details {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        @foreach ($bill_details as $item)
        <div class="item">
            <h1>HÓA ĐƠN TIỀN NHÀ</h1>
            <div>
                <p>Ngày/tháng: {{ $item['date_start'] }}</p>
                <p>Phòng: {{ $item['room_name'] }}</p>
                <hr>
                <div class="details">
                    <p>Tiền phòng</p>
                    <p>{{ $item['room_price'] }}</p>
                </div>
                <div class="details">
                    <p>Điện (CS cũ: {{ $item['pre_electricity'] }} CS mới: {{ $item['current_electricity'] }} SD: {{ $used_electricity }})</p>
                    <p>{{ $electricity_Total }}</p>
                </div>
                <div class="details">
                    <p>Nước (CS cũ: {{ $item['pre_water'] }} CS mới: {{ $item['current_water'] }} SD: {{ $used_water }})</p>
                    <p>{{ $water_Total }}</p>
                </div>
                <div class="details">
                    <p>Rác</p>
                    <p>{{ $item['garbage_price'] }}</p>
                </div>
                <div class="details">
                    <p>Wifi</p>
                    <p>{{ $item['wifi_price'] }}</p>
                </div>
                <div class="details">
                    <p>Tổng tiền</p>
                    <p>{{ $total_price }}</p>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</body>
</html>