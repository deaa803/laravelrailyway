<form action="/products" method="POST">
    @csrf

    <label for="name">اسم المنتج:</label><br>
    <input type="text" name="name" id="name" required><br><br>

    <label for="price">السعر:</label><br>
    <input type="number" name="price" id="price" required><br><br>

    <button type="submit">إضافة المنتج</button>
</form>
