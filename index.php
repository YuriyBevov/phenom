<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Мебельная компания");
?>
<?php
$htaccess_path = __DIR__ . '/.htaccess';

echo '<h3>Проверка .htaccess</h3>';

if (file_exists($htaccess_path)) {
  echo '✅ Файл .htaccess существует<br>';
  echo '📁 Путь: ' . $htaccess_path . '<br>';
  echo '🔒 Права доступа: ' . substr(sprintf('%o', fileperms($htaccess_path)), -4) . '<br>';
  echo '📝 Размер: ' . filesize($htaccess_path) . ' байт<br>';
  echo '👤 Владелец: ' . fileowner($htaccess_path) . '<br>';
  echo '👥 Группа: ' . filegroup($htaccess_path) . '<br>';

  echo '<h4>Содержимое:</h4>';
  echo '<pre>' . htmlspecialchars(file_get_contents($htaccess_path)) . '</pre>';
} else {
  echo '❌ Файл .htaccess НЕ существует в ' . __DIR__ . '<br>';

  // Проверим текущую директорию
  echo '<br>📂 Содержимое текущей папки:<br>';
  $files = scandir(__DIR__);
  foreach ($files as $file) {
    if ($file != '.' && $file != '..') {
      echo '• ' . $file;
      if (is_dir(__DIR__ . '/' . $file)) echo ' (папка)';
      echo '<br>';
    }
  }
}

// Дополнительно проверим, активен ли mod_rewrite
echo '<h4>Проверка mod_rewrite:</h4>';
if (function_exists('apache_get_modules')) {
  $modules = apache_get_modules();
  if (in_array('mod_rewrite', $modules)) {
    echo '✅ mod_rewrite активен<br>';
  } else {
    echo '❌ mod_rewrite НЕ активен<br>';
  }
} else {
  echo '❌ Невозможно проверить mod_rewrite (функция apache_get_modules недоступна)<br>';
  echo '⚠️ Это может означать, что PHP работает в режиме CGI/FastCGI<br>';
}
?>
<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>