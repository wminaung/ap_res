<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Form</title>

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="/plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="/dist/css/adminlte.min.css">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

    <link rel="stylesheet" href="/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <style>
        .dish-image-container {
            background-color: black;
            border-radius: 0.25rem;
        }

        .dish-image {
            background-color: black;
            width: 100%;
            height: 150px;
            opacity: 0.5;
            cursor: pointer;
            border-radius: 0.25rem;
            transition: all 1s;
        }

        .dish-image:hover {
            opacity: 1;
            transform: scale(1.06);

        }


        .apo::after {
            content: "\a";
            white-space: pre;
        }
    </style>
</head>

<body>
    <div class="container-fluid ">
        <div class="row">
            <div class="col-12">
                <h4>
                    Nav Tabs inside Card Header
                    <small>card-tabs / card-outline-tabs</small>
                </h4>
            </div>
        </div>

        <div class="row">
            <div class="col-12  col-sm-6 col-lg-12">
                <div class="card card-primary card-tabs">
                    <div class="card-header p-0 pt-1">
                        <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="custom-tabs-one-home-tab" data-toggle="pill" href="#custom-tabs-one-home" role="tab" aria-controls="custom-tabs-one-home" aria-selected="true">New Order</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="custom-tabs-one-profile-tab" data-toggle="pill" href="#custom-tabs-one-profile" role="tab" aria-controls="custom-tabs-one-profile" aria-selected="false">Order List</a>
                            </li>
                            <!-- <li class="nav-item">
                                <a class="nav-link" id="custom-tabs-one-messages-tab" data-toggle="pill" href="#custom-tabs-one-messages" role="tab" aria-controls="custom-tabs-one-messages" aria-selected="false">Messages</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="custom-tabs-one-settings-tab" data-toggle="pill" href="#custom-tabs-one-settings" role="tab" aria-controls="custom-tabs-one-settings" aria-selected="false">Settings</a>
                            </li> -->
                        </ul>
                    </div>
                    <div class="card-body">
                        @if(session('message'))
                        <div class="alert alert-success">
                            {{ session('message') }}
                        </div>
                        @endif
                        <div class="tab-content" id="custom-tabs-one-tabContent">
                            <div class="tab-pane fade show active" id="custom-tabs-one-home" role="tabpanel" aria-labelledby="custom-tabs-one-home-tab">
                                <form action="{{ route('order.submit') }}" method="post">
                                    @csrf
                                    <div class="row">
                                        @foreach($dishes as $dish)
                                        <div class="col-3 ">
                                            <div class="card h-100 bg-info rounded">
                                                <div class="card-body  d-flex flex-column justify-content-between  ">
                                                    <div class="dish-image-container">
                                                        <img src="{{ url('/images/' . $dish->image) }}" width="200" height="150" class="dish-image" alt="{{$dish->name}}">
                                                    </div><br>
                                                    <label for="">{{ $dish->name }}</label><br>
                                                    <input type="number" name="{{$dish->id}}" value="">
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                    <div class="apo"></div>
                                    <div class="form-group">
                                        <select name="table" id="">
                                            @foreach($tables as $table)
                                            <option class="form-control" value="{{$table->id}}">{{ $table->number }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <br>
                                    <div>
                                        <input type="submit" value="{{ ucfirst('submit') }}" class="btn btn-success">
                                    </div>
                                </form>
                            </div>
                            <div class="tab-pane fade" id="custom-tabs-one-profile" role="tabpanel" aria-labelledby="custom-tabs-one-profile-tab">
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Dish Name</th>
                                            <th>Table Number</th>
                                            <th>status</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($orders as $order)
                                        <tr>
                                            <td>{{$order->dish->name}}</td>
                                            <td>{{$order->table_id}}</td>
                                            <td>{{ $status[$order-> status] }}</td>
                                            <td>
                                                <!-- $dish -> Dish Model -->
                                                <div>
                                                    <div>
                                                        <a href="/order/{{$order->id}}/serve" class="btn btn-warning mr-1">Serve</a>

                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- REQUIRED SCRIPTS -->

    <!-- jQuery -->
    <script src="/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <!-- AdminLTE App -->
    <script src="/dist/js/adminlte.min.js"></script>
</body>

</html>