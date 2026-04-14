<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    @vite(['resources/css/app.css'])
</head>

<body>
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
        <div class="bg-blue-500 p-6 rounded-lg">Riquadro 1</div>
        <div class="bg-red-500 p-6 rounded-lg">Riquadro 2</div>
        <div class="bg-green-500 p-6 rounded-lg col-span-2">Riquadro 3</div>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div class="bg-blue-500 p-6 rounded-lg">Riquadro 1</div>
        <div class="bg-red-500 p-6 rounded-lg">Riquadro 2</div>
    </div>
    <div class="flex justify-between items-center p-4 bg-gray-800 text-white">
        <div class="text-lg font-bold">Logo</div>
        <nav class="flex space-x-4">
            <a href="#" class="hover:text-gray-400">Home</a>
            <a href="#" class="hover:text-gray-400">About</a>
            <a href="#" class="hover:text-gray-400">Contact</a>
        </nav>
    </div>
    <div class="flex p-6 border rounded-lg shadow-lg">
        <!-- Image -->
        <img src="https://via.placeholder.com/150" alt="Placeholder" class="w-32 h-32 rounded-lg">

        <!-- Text Content -->
        <div class="flex flex-col justify-between ml-6">
            <div>
                <h2 class="text-xl font-bold">Card Title</h2>
                <p class="text-gray-600">This is a description of the card content.</p>
            </div>
            <div class="flex space-x-4">
                <button class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">Action 1</button>
                <button class="px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600">Action 2</button>
            </div>
        </div>
    </div>
    <div class="grid grid-cols-3 gap-4">
        <div class="p-4 bg-blue-100">Item 1</div>
        <div class="p-4 bg-blue-200">Item 2</div>
        <div class="p-4 bg-blue-300">Item 3</div>
    </div>
    <div class="grid grid-cols-4 h-screen">
        <!-- Sidebar -->
        <aside class="col-span-1 bg-gray-800 text-white p-4">
            <h2 class="text-lg font-bold">Sidebar</h2>
            <ul class="mt-4 space-y-2">
                <li><a href="#" class="hover:text-gray-400">Link 1</a></li>
                <li><a href="#" class="hover:text-gray-400">Link 2</a></li>
            </ul>
        </aside>

        <!-- Main Content -->
        <main class="col-span-3 p-4">
            <div class="grid grid-cols-2 gap-4">
                <div class="p-4 bg-green-100">Widget 1</div>
                <div class="p-4 bg-green-200">Widget 2</div>
                <div class="p-4 bg-green-300">Widget 3</div>
                <div class="p-4 bg-green-400">Widget 4</div>
            </div>
        </main>
    </div>
    <div class="min-h-screen flex flex-col">
        <!-- Header -->
        <header class="p-4 bg-blue-500 text-white">
            <h1 class="text-2xl font-bold">My Blog</h1>
        </header>

        <!-- Main Content -->
        <main class="flex-1 p-4">
            <article>
                <h2 class="text-xl font-bold">Blog Post Title</h2>
                <p class="mt-2">This is the content of the blog post.</p>
            </article>
        </main>

        <!-- Footer -->
        <footer class="grid grid-cols-3 gap-4 p-4 bg-gray-800 text-white">
            <div>Footer Section 1</div>
            <div>Footer Section 2</div>
            <div>Footer Section 3</div>
        </footer>
    </div>
    <footer class="grid grid-cols-1 md:grid-cols-3 gap-4 p-4 bg-gray-800 text-white">
        <div>Footer Section 1</div>
        <div>Footer Section 2</div>
        <div>Footer Section 3</div>
    </footer>






</body>

</html>