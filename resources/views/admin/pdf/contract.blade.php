<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hợp đồng cho thuê nhà</title>
    <style>
        body {
            font-family: "DejaVu Sans";
        }
        .text-center h1, h2, h3 {
            text-align: center
        }
        .text-end {
            float: right;
            margin-right: 20px;
        }
    </style>
</head>
<body>
    <div class="mt-4 container ">
        <div class="text-center ">
            <h1>CỘNG HÒA XÃ HỘI CHỦ NGHĨA VIỆT NAM</h1>
            <h2>Độc lập - Tự do - Hạnh phúc</h4>
        </div>
        <br>
        <h3 class="mt-3 text-center ">HỢP ĐỒNG THUÊ NHÀ</h3>
        <!-- <br> -->
        <p class="text-end ">Hôm nay, {{ $contract->started_at }}</p>
        <br>
        <p>Tại: Trịnh Văn Bô</p>
        <!-- <strong>Chúng tôi gồm: </strong> -->
        <h5>Chúng tôi gồm: </h5>
        <h4>BÊN A(BÊN CHO THUÊ): </h4>
        <p>Ông(bà): {{ $owner->name }}
        <p>Số CMND: {{ $owner->cccd }}</p>
        <p>HKTT: {{ $owner->address }}</p>
        <p>Số điện thoại: {{ $owner->phone }}</p>
        
        <h4>BÊN B(BÊN THUÊ NHÀ): </h4>
        <table border="1">
            <thead>
                <tr>
                    <th>Ông(bà)</th>
                    <th>Số CMND</th>
                    <th>Hộ khẩu thường trú</th>
                    <th>Số điện thoại</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($members as $item)
                    <tr>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->cccd }}</td>
                        <td>{{ $item->address }}</td>
                        <td>{{ $item->phone }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <P>Cùng thỏa thuận giao kết với các nội dung sau đây: </P>

        <h4>ĐIỀU 1: Thời hạn thuê</h3>
        <p>Bên A đồng ý cho bên B thuê được thuê để sử dụng</p>
        <p>Phòng {{ $room->name }}</p>
        <p class="mx-3">- Tổng diện tích sử dụng {{ $room->width * $room->length }}</p>
        <p class="mx-3">- Kể từ {{ $contract->started_at }}</p>

        <h4>ĐIỀU 2: Gía cho thuê</h3>
        <p class="mx-3">1. Gía thuê nhà là: {{ $room->price }}</p>
        <p class="mx-3">2. Bên B trả tiền thuê nhà cho bên A bằng tiền Việt Nam Đồng theo định kỳ một tháng một lần</p>
        <p class="mx-3">3. Nếu việc giao và nhận số tiền nêu trên do hai bên tự thực hiện và chịu trách nhiệm trước pháp luật. </p>

        <h4>Điều 4: trách nhiệm của bên cho thuê(bên A)</h4>
        <p>- Giao nhà và trang thiết bị, tiện ghi cho bên thuê đúng ngày hợp đồng có giá trị</p>
        <p>- Sửa chữa kịp thời thiết bị hư hỏng</p>
        <p>- Phải bồi thường mọi thiệt hại về vật chất và sức khỏe gây ra cho bên thuê nhà trong trường hợp nhà bị sụp đổ do không sửa chữa kịp thời</p>
        <p>- Hướng dẫn bên thuê nhà thực hiện đúng các quy định của Nhà Nước về tạm trú, tạm vắng</p>

        <h4>Điều 5: Trách nhiệm của bên thuê</h4>
        <p>- Sử dụng đúng nội dung và mục đích thuê. Khi cần sửa chữa, cải tạo theo yêu cầu cần sử dụng riêng phải sử đồng ý của chủ nhà và phải tuân theo những quy định về xây dựng cơ bản</p>
        <p>- Trả tiền thuê nhà đầy đủ đúng quy định</p>
        <p>- Có trách nhiệm về hư hỏng nhà, sự mất mát các trang bị nội thất, các đồ đac, tư trang của bản thân</p>
        <p>- Chấp hành quy tắc về giữ gìn về vệ sinh môi trường và các quy định về trật tự an ninh chung.</p>
        <p>- Không được chuyển nhượng hợp đồng thuê nhà trọ hoặc cho thuê lại nhà nếu chưa được sử đồng ý của bên A</p>

        <h4>Điều 6: Điều khoản chung</h4>
        <p>- Trường hợp một trong hai bên cần chấm dứt hợp đồng thuê nhà trước thời hạn đã ký, phải thông báo cho bên A trước 1 tháng, nếu bbeen nào vi phạm sẽ phải bồi thường 10% tổng số tiền nhà trong 1 tháng</p>
        <p>- Hai bên thực hiện đúng nội dung thỏa thuận trong hợp đồng. Nếu có vấn đề phát sinh ngoài hợp đồng, cà 2 bên cùng giải quyết.</p>
        <p>- Hợp đồng sẽ chấm dứt các trường hợp sau:</p>
        <p class="mt-3">Bên thuê nhà có thể chấm dứt hợp đồng khi bên A tăng giá tiền thuê hoặc các dịch vụ khác một cách bất hợp lí</p>
        <p class="mt-3">Thời hạn hợp đồng đã hết</p>
        <p class="mt-3">Nhà bị tiêu hủy hoặc phá dỡ của nhà nước, hoặc bên có thẩm quyền</p>

        <h4>Điều 7: Thời hạn và hiệp lực của hợp đồng</h4>
        <p>- Hợp đồng này có hiệu lực kể từ lúc hai bên cùng kí và được đóng dấu chứng nhận của cơ quan Nhà Nước có thẩm quyền</p>
        <p>- Hợp đồng được thành lập 2 bản. Mỗi bên giữ 1 bản và có giá trị pháp lí như nhau </p>

        <div >
            <h4 style="float: left">Bên cho thuê</h4>
            <h4 style="float: right">Bên thuê</h4>
        </div>
    </div>
</body>
</html>