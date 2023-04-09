<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $profile->name }} | {{ __('app.btn_print') }}</title>
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/dist/css/adminlte.css') }}">
    <style>
        @font-face {
            font-family: "Hanuman";
            src: url({{ url('assets/font/Hanuman.woff') }}) format("truetype");
        }

        html body {
            font-family: "Hanuman";
        }

        @page {
            size: A4;
            margin: 0mm;
        }

        @media print {

            html,
            body {
                width: 210mm;
                height: 297mm;
                padding: 5mm;
            }

            .font-1rem {
                font-size: 1rem;
            }
        }

        .text-end {
            text-align: end;
        }

        .font-1rem {
            font-size: 1rem;
        }

        th:nth-child(odd) {
            color: #ffffff;
            background-color: #007bff !important;
        }

        th:nth-child(even) {
            color: #ffffff;
            background-color: #007bff !important;
        }
    </style>
</head>

<body>
    <div class="content page p-3">
        <div class=" container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h3 style="margin-top: -7px;">
                        <img src="{{ asset($profile->photo) }}" class="img-size-150" alt="logo">
                        {{ $profile->name }}
                    </h3>
                    <p class="mt-4">អតិថិជនៈ {{ $quote->customer->customer_name ?? '' }} <br>
                        លេខទូរស័ព្ទៈ {{ $quote->customer->customer_phone ?? '' }} <br>
                        អាស័យដ្ខានៈ {{ $quote->customer->customer_address ?? '' }}</p>
                </div>
                <div class="col-sm-6">
                    <div class="float-right text-end">
                        <h3>{{ $profile->name }}
                            <br> <span class="font-1rem">លេខទូរស័ព្ទ៖​ {{ $profile->tel }}</span> <br><span
                                class="font-1rem">អាស័យដ្ខាន៖ {{ $profile->address }}</span>
                        </h3>

                        <h6>{{ __('app.label_quote_no') }} :{{ $sale->sale_no }}</h6>

                        <h6>{{ __('app.table_date') }} :{{ $sale->created_at->format('d-M-Y') }}</h6>
                    </div>
                </div>
            </div>
            <div class="row mt-3 mb-3">
                <div class="col-sm-12">
                    <h4 class=" text-center">{{ __('app.label_invoice') }}</h4>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <table id="" class="table table-bordered">
                        <thead>
                            <tr>
                                <th>{{ __('app.label_no') }}</th>
                                <th>{{ __('app.code') }}</th>
                                <th>{{ __('app.label_name') }}</th>
                                <th>{{ __('app.label_scale') }}</th>
                                <th>{{ __('app.label_qty') }}</th>
                                <th>{{ __('app.label_price') }}</th>
                                <th style="width: 30%">{{ __('app.label_other') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($sale->saleDetail as $index => $item)
                                <tr>
                                    <td>{{ ++$index }}
                                        <input type="hidden" name="add_cart_id[]" value="{{ $item->id }}">
                                        <input type="hidden" name="product_id[]" value="{{ $item->product_id }}">
                                    </td>
                                    <td>{{ $item->product_code }}
                                        <input type="hidden" name="product_code[]" value="{{ $item->product_code }}">
                                    </td>
                                    <td>{{ $item->product_name }}
                                        <input type="hidden" name="product_name[]" value="{{ $item->product_name }}">
                                    </td>
                                    <td>{{ $item->scale }}
                                        <input type="hidden" name="scale[]" value="{{ $item->scale }}">
                                    </td>
                                    <td>{{ $item->qty }}
                                        <input type="hidden" name="qty[]" value="{{ $item->qty }}">
                                    </td>
                                    <td>{{ $item->price }}
                                        <input type="hidden" name="price[]" value="{{ '$' . $item->price }}">
                                    </td>
                                    <td>{{ $item->note }}
                                        <input type="hidden" name="note[]" value="{{ $item->note }}">
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="row justify-content-end">
                <div class="col-sm-3">
                    <table class=" table table-bordered">
                        <tfoot>
                            <tr>
                                <td>{{ __('app.label_total_qty') }}:</td>
                                <td>${{ $sale->total_qty }}</td>
                            </tr>
                            <tr>
                                <td>{{ __('app.label_total_price') }}:</td>
                                <td>${{ $sale->total_price }}</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        window.print();
        window.onafterprint = back;

        function back() {
            window.history.back();
        }
    </script>
</body>

</html>
