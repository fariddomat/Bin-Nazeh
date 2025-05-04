<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>File Browser</title>
    <!-- Tailwind CSS for styling (optional, you can use your own CSS) -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        .image-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
            gap: 10px;
            padding: 20px;
        }
        .image-item {
            cursor: pointer;
            border: 1px solid #ddd;
            padding: 5px;
            text-align: center;
        }
        .image-item img {
            max-width: 100%;
            height: auto;
        }
        .image-item:hover {
            background-color: #f0f0f0;
        }
    </style>
</head>
<body class="bg-gray-100">
    <div class="container mx-auto">
        <h1 class="text-2xl font-bold my-4">Select an Image</h1>
        <div class="image-grid">
            @if (empty($files))
                <p class="text-gray-500">No images found.</p>
            @else
                @foreach ($files as $file)
                    <div class="image-item" onclick="selectImage('{{ Storage::url($file) }}')">
                        <img src="{{ Storage::url($file) }}" alt="{{ basename($file) }}" title="{{ basename($file) }}">
                        <p class="text-sm truncate">{{ basename($file) }}</p>
                    </div>
                @endforeach
            @endif
        </div>
    </div>

    <script>
        function selectImage(url) {
            // Pass the selected image URL back to CKEditor
            window.opener.CKEDITOR.tools.callFunction({{ $CKEditorFuncNum }}, url);
            window.close(); // Close the browser window
        }
    </script>
</body>
</html>
