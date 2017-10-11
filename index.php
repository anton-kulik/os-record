<?php

session_start();

/*
if(!isset($_SESSION['auth'])) {
    header('Location: auth.php');
    exit;
}
*/

?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="/img/favicon.png">

    <title>Запись онлайн Omega-Service</title>

    <link href="/css/bootstrap.min.css" rel="stylesheet">
    <script src="/js/jquery.js"></script>

    <script>
        function markSucFunc(data) {
            try {
                var _data = jQuery.parseJSON(data);
            } catch (e) {
                alert('ошибка получения марок авто');
                console.log(e);
            }
            var dataTD = '';
            for (var i = 0; i < _data.length; i++) {

                if(_data[i]['name'] === 'Opel') {
                    dataTD += '<option selected value="' + _data[i]['id'] + '">' + _data[i]['name'] + '</option>';
                } else {
                    dataTD += '<option value="' + _data[i]['id'] + '">' + _data[i]['name'] + '</option>';
                }
            }
            $('#inputMark').append(dataTD);
        }

        function modelSucFunc(data) {
            try {
                var _data = jQuery.parseJSON(data);
            } catch (e) {
                alert('ошибка получения моделей авто');
                console.log(e);
            }
            var dataTD = '';
            for (var i = 0; i < _data.length; i++) {
                dataTD += '<option value="' + _data[i]['id'] + '">' + _data[i]['name'] + '</option>';
            }
            $('#inputModel').text('');
            $('#inputModel').append(dataTD);
        }

        function getMarks() {
            $.ajax({
                url: '/common/getMarks.php',
                type: 'post',
                data: 'getMarks=true',
                success: markSucFunc
            });
        }

        function getModels() {
            var inputMark = $('#inputMark');
            $.ajax({
                url: '/common/getModels.php',
                type: 'post',
                data: 'mark_id=' + inputMark.val(),
                success: modelSucFunc
            });
        }

        $(document).ready(function () {
            var inputMark = $('#inputMark');
            getMarks();
            setTimeout(getModels, 50);
            inputMark.on('change', function () {
                getModels();
            });
        })
    </script>

</head>

<body>
<div class="container">

    <h1>Запись онлайн в Omega-Service</h1>
    <p class="lead">Запись на техобслуживание автомобиля</p>

    <form>
        <div class="form-row">
            <div class="form-group col-md-3">
                <label for="inputName" class="col-form-label">Ваше имя</label>
                <input type="password" class="form-control" id="inputPassword4" placeholder="Ваше имя">
            </div>
            <div class="form-group col-md-3">
                <label for="inputPhone" class="col-form-label">Номер мобильного</label>
                <input name="phone_number" type="number" class="form-control" id="inputPhone"
                       placeholder="Номер мобильного">
            </div>
            <div class="form-group col-md-2">
                <label for="inputDay" class="col-form-label">Выберите день</label>
                <input class="form-control" id="inputDay" type="date" min="<?php echo date('Y-m-d') ?>" value="<?php echo date('Y-m-d') ?>">
            </div>
            <div class="form-group col-md-2">
                <label for="inputHour" class="col-form-label">Часы</label>
                <select class="form-control" name="inputHour" id="inputHour">
                    <?php
                    $hours = range(9, 19);
                    for($i = 0; $i < count($hours); $i++ ) {
                        echo '<option value="' . $hours[$i] . '">' . $hours[$i] . '</option>';
                    }
                    ?>
                </select>
            </div>
            <div class="form-group col-md-2">
                <label for="inputMin" class="col-form-label">Минуты</label>
                <select class="form-control" name="inputMin" id="inputMin">
                    <option value="00">00</option>
                    <option value="15">15</option>
                    <option value="30">30</option>
                    <option value="45">45</option>
                </select>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-3">
                <label for="inputMark" class="col-form-label">Марка автомобиля</label>
                <select class="form-control" name="inputMark" id="inputMark"></select>
            </div>
            <div class="form-group col-md-3">
                <label for="inputModel" class="col-form-label">Модель автомобиля</label>
                <select class="form-control" name="inputModel" id="inputModel">
                    <option selected disabled>Сначала выберите марку
                </select>
            </div>
            <div class="form-group col-md-2">
                <label for="inputYear" class="col-form-label">Год выпуска</label>
                <select class="form-control" name="inputYear" id="inputYear">
                    <?php
                    $range = range(1970, date('Y'));
                    for ($i = count($range) - 1; $i > 0; $i--) {
                        if ($range[$i] === 2017) {
                            echo '<option selected value="' . $range[$i] . '">' . $range[$i] . '</option>';
                        } else {
                            echo '<option value="' . $range[$i] . '">' . $range[$i] . '</option>';
                        }
                    }

                    ?>
                </select>
            </div>
            <div class="form-group col-md-2">
                <label for="inputEngineAmount" class="col-form-label">Обьем двигателя</label>
                <input name="inputEngineAmount" type="number" class="form-control" id="inputEngineAmount"
                       placeholder="Обьем двигателя">
            </div>
            <div class="form-group col-md-2">
                <label for="inputEngineValves" class="col-form-label">Количество клапанов</label>
                <input name="inputEngineValves" type="number" class="form-control" id="inputEngineValves"
                       placeholder="Количество клапанов">
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-12">
                <label for="inputDesc" class="col-form-label">Опишите что хотите сделать с автомобилем</label>
                <textarea id="inputDesc" class="form-control" name="inputDesc" cols="30" rows="10"></textarea>
            </div>
        </div>

        <div class="form-group">
            <div class="form-check">
                <label class="form-check-label">
                    <input class="form-check-input" type="checkbox"> Замена масла
                </label>
            </div>
            <div class="form-check">
                <label class="form-check-label">
                    <input class="form-check-input" type="checkbox"> Замена тормозных колодок
                </label>
            </div>
            <div class="form-check">
                <label class="form-check-label">
                    <input class="form-check-input" type="checkbox"> Электрика/электроника
                </label>
            </div>
        </div>


        <div class="form-group">
            <div class="form-check">
                <label class="form-check-label">
                    <input class="form-check-input" type="checkbox"> Перезвоните мне
                </label>
            </div>
        </div>

        <div class="form-group">
            <div class="col-md-12">
                <button style="display: block; margin: 0 auto" type="submit" class="text-center btn btn-primary">Записаться</button>
            </div>
        </div>


    </form>

</div>
</body>
</html>



