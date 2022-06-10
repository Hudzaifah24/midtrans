<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" rel="stylesheet">
        <link rel="stylesheet" href="{{asset('assets/style.css')}}">
    </head>

    <body>
        <form action="{{url('payment')}}" method="GET">
            <h1>Data Diri</h1>
            <div class="formcontainer">
            <hr/>
            <div class="container">
              <label for="nama"><strong>Nama Depan</strong></label>
              <input type="text" placeholder="Masukkan Nama" name="first_name" required>
              <label for="nama"><strong>Nama Belakang</strong></label>
              <input type="text" placeholder="Masukkan Nama" name="last_name" required>
              <label for="email"><strong>Email</strong></label>
              <input type="text" placeholder="Masukkan Email" name="email" required>
              <label for="phone"><strong>Nomor HP</strong></label>
              <input type="text" placeholder="Masukkan No HP" name="phone" required>
            </div>
            <button type="submit">Lanjut</button>
        </form>

        <div class="container">
            <div class="card">
                <div class="card-body">
                    @foreach ($datas as $data)
                        <ul>
                            <li>Nama: <strong>{{$data->name}}</strong></li>
                            <li>Email: {{$data->email}}</li>
                            <li>Phone: {{$data->phone}}</li>
                            <li>Status Code: {{$data->status_code}}</li>
                            <li>Status Transaction: {{$data->status_transaction}}</li>
                            <li>TransactionId: {{$data->transaction_id}}</li>
                            <li>OrderId: {{$data->order_id}}</li>
                            <li>Gross Amount: {{$data->gross_amount}}</li>
                            <li>Payment Type: {{$data->payment_type}}</li>
                            <li>Payment Code: {{$data->payment_code == null ? '-' : $data->payment_code}}</li>
                            <li>Pdf Invoice<a href="{{$data->pdf_url}}" target="blank">{{$data->pdf_url == null ? '-' : 'PDF'}}</a></li>
                        </ul>
                    @endforeach
                </div>
            </div>
        </div>

        @if (session('alert-success'))
            <script>alert("{{session('alert-success')}}")</script>
        @elseif (session('alert-failed'))
            <script>alert("{{session('alert-failed')}}")</script>
        @endif
    </body>
</html>
