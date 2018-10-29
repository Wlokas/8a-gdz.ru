<form method="post" enctype="multipart/form-data">
    <p>
    <select name="leasson[]">
        <option value="0">Русский Язык</option>
        <option value="1">Литература</option>
        <option value="2">Алгебра</option>
        <option value="3">Геометрия</option>
        <option value="4">Информатика</option>
        <option value="5">Обществознание</option>
        <option value="6">История</option>
        <option value="7">История СПБ</option>
        <option value="8">География</option>
        <option value="9">Физика</option>
        <option value="10">Химия</option>
        <option value="11">Биология</option>
        <option value="12">Музыка</option>
        <option value="13">ИЗО</option>
        <option value="14">Физкультура</option>
        <option value="15">ОБЖ</option>
        <option value="16">Технология</option>
        <option value="17">Англ. Яз (1 группа)</option>
        <option value="18">Англ. Яз (2 группа)</option>
    </select><span style="color: red">*</span></p>
    <p><label for="topic">Тема урока:</label> <input type="text" id="topic" name="topic" placeholder="Малекулярные частицы"><span style="color: red">*</span></p>
    <p><label for="dz">Домашнее задание:</label> <input type="text" id="dz" name="dz" placeholder="Стр 25 №21"><span style="color: red">*</span></p>
    <p><label for="gdz_link">ГДЗ Ссылка:</label> <input type="text" id="gdz_link" name="gdz_link" placeholder="https://gdz.ru/"></p>
    <p><label for="gdz_text">ГДЗ Текст:</label> <textarea name="gdz_text" id="gdz_text"></textarea></p>
    <p><label for="gdz_img">Прикрепить картинку:</label> <input type="file" id="gdz_img" name="gdz_img"></p>
    <p><label for="date">Выберите дату:</label> <input type="date" id="date" name="date" value="{%DATE%}"><span style="color: red">*</span></p>
    <button>Создать ГДЗ</button>
</form>