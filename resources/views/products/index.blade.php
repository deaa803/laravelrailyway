<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <title>قائمة المنتجات</title>
</head>
<body>
<h1>قائمة المنتجات</h1>
<ul>
    @foreach($products as $product)
        <li>{{ $product->name }} - السعر: {{ $product->price }} $</li>
    @endforeach
</ul>

</body>
</html>
