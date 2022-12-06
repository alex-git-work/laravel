@extends('admin.layouts.master')

@section('title', 'Итого')

@section('content')
    <div class="card w-100">
        <div class="card-body">
            <div class="card card-primary w-50">
                <div class="card-header">
                    <h3 class="card-title">Параметры</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12 pl-4">
                            <form method="post" action="{{ route('admin.report.store') }}" class="m-0">
                                @csrf
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" role="switch" name="report[]" value="article" id="article" checked>
                                    <label class="form-check-label" for="article">Статьи</label>
                                </div>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" role="switch" name="report[]" value="news" id="news">
                                    <label class="form-check-label" for="news">Новости</label>
                                </div>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" role="switch" name="report[]" value="comment" id="comment">
                                    <label class="form-check-label" for="comment">Комментарии</label>
                                </div>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" role="switch" name="report[]" value="tag" id="tag">
                                    <label class="form-check-label" for="tag">Теги</label>
                                </div>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" role="switch" name="report[]" value="user" id="user">
                                    <label class="form-check-label" for="user">Пользователи</label>
                                </div>
                                <div class="mt-5 mb-2">
                                    <button type="submit" class="btn btn-primary btn-report ml-n4">Сгенерировать отчёт</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    Результат будет отправлен на ваш e-mail адрес.
                </div>
            </div>
        </div>
    </div>
@endsection

@section('page-specific-scripts')
    <!-- Report button toggle -->
    <script>
        $('input[type="checkbox"]').on('change', function () {
            $('.btn-report').prop('disabled', $('.form-check-input:checked').length === 0);
        });
    </script>
@endsection
