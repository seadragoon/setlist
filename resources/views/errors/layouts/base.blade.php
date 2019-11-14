<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>@yield('title')</title>
  <style>
    .error-wrap {
      padding: 5px 20px;
      border: 1px solid #dcdcdc;
      display: inline-block;
      box-shadow: 0px 0px 8px #dcdcdc;
    }
    h1 { font-size: 18px; }
    p { margin-left: 10px; }
  </style>
</head>
<body>
  <div class="error-wrap">
    <section>
      <h1>@yield('title')</h1>
      <p>@yield('message')</p>
      @yield('link')
    </section>
  </div>
</body>
</html>