<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">
    <nav class="bg-white shadow-md p-4 flex justify-between items-center">
        <h1 class="text-xl font-bold text-blue-600">My App</h1>
        <form method="POST" action="/logout">
            @csrf
            <button type="submit" class="text-red-500 hover:text-red-700 font-medium">Đăng xuất</button>
        </form>
    </nav>

    <div class="container mx-auto mt-10 p-6">
        <div class="bg-white rounded-lg shadow-lg p-8">
            <h2 class="text-2xl font-semibold mb-4">Chào mừng bạn quay trở lại! 👋</h2>
            <p class="text-gray-600">Đây là trang Dashboard sau khi bạn đã đăng nhập thành công.</p>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-8">
                <div class="p-4 bg-blue-50 border border-blue-100 rounded-lg text-center">
                    <span class="block text-2xl font-bold text-blue-600">12</span>
                    <span class="text-gray-500">Bài đăng của bạn</span>
                </div>
            </div>
        </div>
    </div>
</body>

</html>