@extends('layouts.new-app')

@section('title', 'Каскадный вывод комментариев')

@section('content')

    @if(session('success'))
        <div class="alert alert-success" style="color: green">
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->all())
        <div class="alert alert-danger">
            @foreach($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    @foreach ($comments as $comment)
        @include('comments.comment', ['comment' => $comment])
    @endforeach
    <div id="popup" class="popup">
        <div class="popup-content">
            <span class="close" onclick="closePopup()">&times;</span>
            <h2>Форма ответа</h2>
            <form id="yourFormId" method="post" action="{{ route('comments.store') }}" enctype="multipart/form-data">
                @csrf
                <input type="hidden" id="parent_id" name="parent_id">
                <div>
                    <label for="username">User Name:</label>
                    <input type="text" id="username" name="username" required>
                </div>
                <div>
                    <label for="email">E-mail:</label>
                    <input type="email" id="email" name="email" required>
                </div>
                <div>
                    <label for="url">Home Page:</label>
                    <input type="url" id="url" name="url">
                </div>
                <div>
                    <label for="text">Text:</label>
                    <textarea id="text" name="text"></textarea>
                </div>
                <div>
                    <label for="image">Выберите изображение:</label>
                    <input type="file" id="image" name="image">
                </div>
                <div>
                    <label for="file">Выберите файл:</label>
                    <input type="file" id="file" name="file">
                </div>

                {!! NoCaptcha::renderJs() !!}
                {!! NoCaptcha::display() !!}

                <button type="submit">Отправить</button>
            </form>
        </div>
    </div>

    <script>
        document.getElementById('reply-button').addEventListener('click', openPopup);

        function openPopup(parent_id) {
            document.getElementById('popup').style.display = 'block';
            document.getElementById('parent_id').value = parent_id;
        }

        function closePopup() {
            document.getElementById('popup').style.display = 'none';
        }
    </script>

@endsection

