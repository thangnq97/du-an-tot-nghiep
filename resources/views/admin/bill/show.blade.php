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

        

        h1 {
            text-align: center;
            margin-bottom: 20px;
        }

      

        .details>p {
           display: inline-flex;
            
        }
        .details{
            display:flex;
            justify-content: space-between; 
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
                    <p >Phòng: {{ $item['room_name'] }}</p>
                    <hr>
                    <div class="details">
                        <p class="room-label">Tiền phòng: </p>
                        <p class="room-price">{{ number_format($item['room_price'], 0, ',', '.') }} VNĐ</p>
                    </div>

                    <div class="details" style="display: flex">
                        <p>Điện (CS cũ: {{ $item['pre_electricity'] }}, CS mới: {{ $item['current_electricity'] }}, SD:
                            {{ $used_electricity }}, Giá: {{ number_format($item['electricity_price'], 0, ',', '.') }})</p>
                        <p>: {{ number_format($electricity_Total, 0, ',', '.') }} VNĐ</p>
                    </div>
                    
                    <div class="details">
                        <p>Nước (CS cũ: {{ $item['pre_water'] }}, CS mới: {{ $item['current_water'] }}, SD:
                            {{ $used_water }}, Giá: {{ number_format($item['water_price'], 0, ',', '.') }})</p>
                        <p style="">{{ number_format($water_Total, 0, ',', '.') }} VNĐ</p>
                    </div>
                    
                    <div class="details">
                        {!! $item['description_room'] !!}
                    </div>
                    
                    <div class="details">
                        {!! $item['description'] !!}
                    </div>
                    
                    <hr>
                    
                    <div class="details">
                        <p>Tổng tiền : </p>
                        <p>{{ number_format($total_price, 0, ',', '.') }} VNĐ</p>
                    </div>
                </div>
            </div>
        @endforeach

    </div>
</body>

</html>
