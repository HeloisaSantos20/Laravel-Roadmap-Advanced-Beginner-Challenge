<!DOCTYPE html>
<html>

<head>
    <style>
        body {
            position: relative;
        }

        .container {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }

        .title {
            margin: 5% 10%;
        }

    </style>
</head>

<body style="background-color:#EDF2F7; height: 100vh">
    <div class="container block bg-white w-[65%] height-auto" style="display: block; background-color: white; width: 65%; height: auto; margin: 0 auto; padding: 2% 0%; box-shadow: 0 0 5px 1px #b3adcd29;">
        <div class="title">
            <h1>Hi!</h1>
            <p>You have been assigned to task: <strong>{{ $task->title }}</strong>.</p>
            @if($task->description)
                <p><strong> Description: </strong> {!! $task->description !!}</p>
            @endif
            <p><strong> Created at:</strong> {{ $task->created_at }}</p>
            <p><strong> Deadline:</strong> {{ $task->deadline }}</p>
        </div>
    </div>
</body>

</html>