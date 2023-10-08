@extends('layouts.admin.app')

@section('content')
    <div class="row g-3">
        <div class="col-12">
            <div class="card">
                <div class="card-body" id="section-to-print">
                    <div class="invoice-area">
                        <div class="invoice-head">
                            <table class="table invoice-table table-borderless mb-0">
                                <tbody>
                                    <tr>
                                        <td class="p-0 pb-3">
                                            <img src="{{ !is_null($setting) ? asset($setting->logo) : asset('frontend/assets/images/logo/logo.png') }}"
                                                height="60" alt="Logo">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="p-0">{{ !is_null($setting) ? $setting->title : '' }}</td>
                                    </tr>
                                    <tr>
                                        <td class="p-0">{{ !is_null($setting) ? $setting->address : '' }}</td>
                                    </tr>
                                    <tr>
                                        <td class="p-0"><a
                                                href="mailto: {{ !is_null($setting) ? $setting->primary_email : '' }}"
                                                target="_top">{{ !is_null($setting) ? $setting->primary_email : '' }}</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="p-0"><a
                                                href="tel: {{ !is_null($setting) ? $setting->primary_mobile : '' }}"
                                                target="_top">{{ !is_null($setting) ? $setting->primary_mobile : '' }}</a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="row g-3 grid-col">
                            <div class="col-md-6">
                                <div class="invoice-address">
                                    <h5>SHIPPING INFORMATION:</h5>
                                    <div class="">
                                        <label class="form-label"><b>Name : </b></label>
                                        <span>{{ $order->address->name }}</span>
                                    </div>
                                    <div class="">
                                        <label class="form-label"><b>Phone : </b></label>
                                        <span>{{ $order->address->phone }}</span>
                                    </div>
                                    <div class="">
                                        <label class="form-label"><b>Email : </b></label>
                                        <span>{{ $order->address->email }}</span>
                                    </div>
                                    <div class="">
                                        <label class="form-label"><b>Pickup : </b></label>
                                        <span>{{ $order->address->address_type }}</span>
                                    </div>
                                    <div class="">
                                        <label class="form-label"><b>Address : </b></label>
                                        <span>{{ $order->address->address }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="invoice-address">
                                    <h5>ORDER INFORMATION</h5>
                                    <div class="">
                                        <label class="form-label"><b>Date : </b></label>
                                        <span>{{ $order->created_at->format('d M Y h:i A') }}</span>
                                    </div>
                                    <div class="">
                                        <label class="form-label"><b>Invoice Number : </b></label>
                                        <span>#{{ $order->order_code }}</span>
                                    </div>
                                    <div class="">
                                        <label class="form-label"><b>Payment Method : </b></label>
                                        <span>{{ $order->payment_method }}</span>
                                    </div>
                                    <div class="alert-items">
                                        <label class="form-label"><b>Status : </b></label>
                                        <span
                                            class="btn btn-xs {{ $order->status == 'Pending' || $order->status == 'Confirmed' || $order->status == 'Processing' ? 'alert-primary' : '' }} {{ $order->status == 'Delivered' || $order->status == 'Successed' ? 'alert-success' : '' }} {{ $order->status == 'Canceled' ? 'alert-danger' : '' }}">{{ $order->status }}</span>
                                    </div>
                                    @if ($order->status == 'Confirmed')
                                        <div class="">
                                            <label class="form-label"><b>Confirmed : </b></label>
                                            <span>{{ date('d M Y h:i A', strtotime($order->confirmed_at)) }}</span>
                                        </div>
                                    @elseif ($order->status == 'Processing')
                                        <div class="">
                                            <label class="form-label"><b>Processing : </b></label>
                                            <span>{{ date('d M Y h:i A', strtotime($order->processing_at)) }}</span>
                                        </div>
                                    @elseif ($order->status == 'Delivered')
                                        <div class="">
                                            <label class="form-label"><b>Delivered : </b></label>
                                            <span>{{ date('d M Y h:i A', strtotime($order->delivered_at)) }}</span>
                                        </div>
                                    @elseif ($order->status == 'Successed')
                                        <div class="">
                                            <label class="form-label"><b>Successed : </b></label>
                                            <span>{{ date('d M Y h:i A', strtotime($order->successed_at)) }}</span>
                                        </div>
                                    @elseif ($order->status == 'Canceled')
                                        <div class="">
                                            <label class="form-label"><b>Canceled : </b></label>
                                            <span>{{ date('d M Y h:i A', strtotime($order->canceled_at)) }}</span>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="invoice-table table-responsive mt-5">
                            <table class="table table-bordered table-hover align-middle table-striped">
                                <thead>
                                    <tr class="text-capitalize">
                                        <th class="text-center">#SL</th>
                                        <th>Product</th>
                                        <th>Regular Price</th>
                                        <th class="text-center">Discount</th>
                                        <th class="text-center">Qty</th>
                                        <th class="text-center">Sale Price</th>
                                        <th class="text-end">total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($order->products as $key => $product)
                                        <tr>
                                            <td class="text-center">{{ $key + 1 }}</td>
                                            <td>{{ $product->product_name }}
                                                @if ($product->variant)
                                                    @php
                                                        $attribute_names = [];
                                                        $values = explode('-', $product->variant->variant);
                                                    @endphp
                                                    @foreach (json_decode($product->product->choice_options) as $key => $choice)
                                                        @php
                                                            $attribute_names[] = \App\Models\Attribute::find($choice->attribute_id)->name;
                                                        @endphp
                                                    @endforeach
                                                    <div class="text-xxs pt-1">
                                                        @foreach ($attribute_names as $key => $name)
                                                            {{ $key > 0 ? ', ' : '' }} {{ $name }} :
                                                            {{ $values[$key] }}
                                                        @endforeach
                                                    </div>
                                                @endif
                                            </td>
                                            <td>{{ $product->regular_price }}</td>
                                            <td class="text-center">{{ $product->product_discount }}</td>
                                            <td class="text-center">{{ $product->quantity }}</td>
                                            <td class="text-center">{{ number_format($product->sale_price) }} TK.</td>
                                            <td class="text-end">
                                                {{ number_format($product->sale_price * $product->quantity) }} TK.</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot class="text-end">
                                    <tr>
                                        <td colspan="6">Sub total :</td>
                                        <td colspan="1">{{ number_format($order->sub_total) }} TK.</td>
                                    </tr>
                                    <tr>
                                        <td colspan="6">Shipping Charge :</td>
                                        <td colspan="1">{{ number_format($order->shipping_charge) }} TK.</td>
                                    </tr>
                                    <tr>
                                        <td colspan="6">Discount :</td>
                                        <td colspan="1">{{ number_format($order->discount) }} TK.</td>
                                    </tr>
                                    <tr>
                                        <td colspan="6">Total :</td>
                                        <td colspan="1">{{ number_format($order->total) }} TK.</td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                    <div class="invoice-buttons text-end">
                        <a href="{{ route('admin.order.show', $order->id) }}" target="_blank" class="invoice-btn">print
                            invoice</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
