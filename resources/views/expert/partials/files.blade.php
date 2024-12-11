@php
// $data - данные поля (строка или массив)
// $name - имя поля file_...
@endphp

@if(isset($data))
@if(is_array($data))
<p>Загруженные файлы:</p>
<ul>
    @foreach($data as $file)
    @if(!empty($file))
    <li><a href="{{ asset('storage/' . $file) }}" target="_blank">Скачать</a></li>
    @endif
    @endforeach

</ul>
@else
<p>Загруженный файл: <a href="{{ asset('storage/' . $data) }}" target="_blank">Скачать</a></p>
@endif
@endif
<div class="form-group">
    <label>Загрузить файлы (можно несколько)</label>
    <input type="file" name="{{ $name }}[]" class="form-control-file" multiple>
</div>
