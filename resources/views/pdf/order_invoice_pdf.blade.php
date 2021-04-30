<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Example 1</title>
    <style>
      .clearfix:after {
        content: "";
        display: table;
        clear: both;
      }
      
      a {
        color: #5D6975;
        text-decoration: underline;
      }
      
      body {
        position: relative;
        width: 21cm;  
        height: 29.7cm; 
        margin: 0 auto; 
        color: #001028;
        background: #FFFFFF; 
        font-family: Arial, sans-serif; 
        font-size: 12px; 
        font-family: Arial;
      }
      
      header {
        padding: 10px 0;
        margin-bottom: 30px;
      }
      
      #logo {
        text-align: center;
        margin-bottom: 10px;
      }
      
      #logo img {
        width: 90px;
      }
      
      h1 {
        border-top: 1px solid  #5D6975;
        border-bottom: 1px solid  #5D6975;
        color: #5D6975;
        font-size: 2.4em;
        line-height: 1.4em;
        font-weight: normal;
        text-align: center;
        margin: 0 0 20px 0;
      }
      
      #project {
        float: left;
      }
      
      #project span {
        color: #5D6975;
        text-align: right;
        width: 52px;
        margin-right: 10px;
        display: inline-block;
        font-size: 0.8em;
      }
      
      #company {
        float: right;
        text-align: right;
      }
      
      #project div,
      #company div {
        white-space: nowrap;        
      }
      
      table {
        width: 100%;
        border-collapse: collapse;
        border-spacing: 0;
        margin-bottom: 20px;
      }
      
      table tr:nth-child(2n-1) td {
        background: #F5F5F5;
      }
      
      table th,
      table td {
        text-align: center;
      }
      
      table th {
        padding: 5px 20px;
        color: #5D6975;
        border-bottom: 1px solid #C1CED9;
        white-space: nowrap;        
        font-weight: normal;
      }
      
      table .service,
      table .desc {
        text-align: left;
      }
      
      table td {
        padding: 20px;
        text-align: right;
      }
      
      table td.service,
      table td.desc {
        vertical-align: top;
      }
      
      table td.unit,
      table td.qty,
      table td.total {
        font-size: 1.2em;
      }
      
      table td.grand {
        border-top: 1px solid #5D6975;;
      }
      
      #notices .notice {
        color: #5D6975;
        font-size: 1.2em;
      }
      
      footer {
        color: #5D6975;
        width: 100%;
        height: 30px;
        position: absolute;
        bottom: 0;
        border-top: 1px solid #C1CED9;
        padding: 8px 0;
        text-align: center;
      }
    </style>
  </head>
  <body>
    <header class="clearfix">
      <div id="logo">
      </div>
      <h1>INVOICE #{{ $id }}</h1>
      <div id="company" class="clearfix">
        <div>Amar Store</div>
        <div>34A Station Road, <br /> Rangpur, Bangladesh</div>
        <div>+880 1784996428</div>
        <div><a href="mailto:amarstore.info@gmail.com">amarstore.info@gmail.com</a></div>
      </div>
      <div id="project">
        <div><span>CUSTOMER </span>{{ $name }}</div>
        <div><span>ADDRESS </span> @if(!empty($address)) {{ $address }}, @endif
						@if(!empty($city)) {{ $city }}, @endif @if(!empty($state)) {{ $state }} @endif</div>
        <div><span>EMAIL </span> <a href="mailto:{{ $email }}">{{ $email }}</a></div>
        <div><span>DATE </span> {{ date("F j, Y", strtotime($created_at)) }} at {{ date("g:i a", strtotime($created_at)) }}</div>
      </div>
    </header>
    <main>
      <table>
        <thead>
          <tr>
            <th class="service">DESCRIPTION</th>
            <th class="desc">PRICE</th>
            <th style="text-align:center">QTY</th>
            <th>TOTAL</th>
          </tr>
        </thead>
        <tbody>
            <?php $subTotal = 0; ?>
            @foreach($order_products as $product)
              <tr>
                <td class="desc">
                  Name: {{ $product['product_name'] }} <br>
                  Code: {{ $product['product_code'] }} <br>
                  Size: {{ $product['product_size'] }} <br>
                  Color: {{ $product['product_color'] }}
                </td>
                <td class="unit">Tk.{{ $product['product_price'] }}</td>
                <td class="qty">{{ $product['product_qty'] }}</td>
                <td class="total">Tk.{{ $product['product_price'] * $product['product_qty'] }}</td>
              </tr>
            <?php $subTotal += ($product['product_price'] * $product['product_qty']); ?>
            @endforeach
          </tr>
          <tr>
            <td colspan="3">SUBTOTAL</td>
            <td class="total">TK.{{ $subTotal }}</td>
          </tr>
          <tr>
            <td colspan="3">SHIIPING</td>
            <td class="total">TK.0</td>
          </tr>
          <tr>
            <td colspan="3">DISCOUNT</td>
              @if($coupon_amount > 0)
                <td class="total">Tk.{{ $coupon_amount }}</td>
              @else
                <td class="total">TK.0</td>
              @endif
          </tr>
          <tr>
            <td colspan="3" class="grand total">GRAND TOTAL</td>
            <td class="grand total">Tk.{{ $grand_total }}</td>
          </tr>
        </tbody>
      </table>
      <div id="notices">
        <div>NOTICE:</div>
        <div class="notice">A finance charge of 1.5% will be made on unpaid balances after 30 days.</div>
      </div>
    </main>
    <footer>
      Invoice was created on a computer and is valid without the signature and seal.
    </footer>
  </body>
</html>