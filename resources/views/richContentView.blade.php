<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>


    <style>
        {{ $content->css }}
    </style>
    <link rel="stylesheet" href="/css/richContent.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="/js/tailwindconfig.js"></script>
</head>
{!! $content->html !!}
</html>
