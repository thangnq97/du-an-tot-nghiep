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
                        <p>Tiền phòng</p>
                        <p style="padding-left: 515px">{{ $item['room_price'] }}</p>
                    </div>

                    <div class="details" style="display: flex">
                        <p>Điện (CS cũ: {{ $item['pre_electricity'] }}, CS mới: {{ $item['current_electricity'] }}, SD:
                            {{ $used_electricity }}, Giá: {{ $item['electricity_price'] }})</p>
                        <p style="padding-left: 310px">{{ $electricity_Total }}</p>
                    </div>

                    <div class="details">
                        <p>Nước (CS cũ: {{ $item['pre_water'] }}, CS mới: {{ $item['current_water'] }}, SD:
                            {{ $used_water }}, Giá: {{ $item['water_price'] }})</p>
                        <p style="padding-left: 310px">{{ $water_Total }}</p>
                    </div>
                   
                    <div class="details">
                        {!! $item['description_room'] !!}
                    </div>

                    <div class="details">
                        {!! $item['description'] !!}
                    </div>
                   
                    <hr>
                    <div class="details">
                        <p>Tổng tiền</p>
                        <p style="padding-left: 530px">{{ $total_price }}</p>
                    </div>
                </div>
            </div>
        @endforeach

    </div>
</body>

</html>
