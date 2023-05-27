<?php

error_reporting(E_ALL ^E_STRICT ^E_NOTICE);
//ini_set('display_errors',1);

require 'vendor/autoload.php';
require 'vendor/avadim/fast-excel-writer/src/autoload.php';

use \avadim\FastExcelWriter\Excel;

$data = json_decode($_REQUEST['data'], true);
$data = $data['data'];

try {
    if (empty($data)){
        throw new \Exception('require data');
    }

    $width = $data['width'];
    $sections = $data['sections'];

    $excel = Excel::create(['Sheet1']);
    $sheet = $excel->getSheet();

    $rowIndex = 0;
    foreach ($sections as $section) {
        $style = $section['style'] ?? [];

        foreach ($section['rows'] ?? [] as $row) {
            foreach ($row as $columnIndex => $cell) {
                $cellAddress = Excel::cellAddress($rowIndex + 1, $columnIndex + 1);


                if (!is_array($cell) && $cell) {
                    $sheet->setValue($cellAddress, $cell, $style);
                    continue;
                }

                if ($cell['empty'] ?? false) {
                    continue;
                }

                $cellToMergeTo = Excel::cellAddress($rowIndex + ($cell['depth'] ?? 1), $columnIndex + ($cell['breadth'] ?? 1));
                $sheet->setValue("$cellAddress:$cellToMergeTo", $cell['value'] ?? '', $style);
                $sheet->setStyle($cellToMergeTo, $style);
            }

            if ($height = $style['height'] ?? 0) {
                $sheet->setRowHeight($rowIndex + 1, $height);
            }

            $rowIndex += 1;
        }
    }

    if (is_array($width) && !empty($width)){
        $sheet->setColWidths($width);
    }

    $fileName = generateRandomString() . '.' . 'xlsx';
    $fileName = DIRECTORY_SEPARATOR . 'tmp' . DIRECTORY_SEPARATOR . $fileName;

    $excel->save($fileName);


    header('Content-Description: File Transfer');
    header ("Content-Type: application/octet-stream");
    header('Content-Transfer-Encoding: binary');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header ("Content-Length: ".filesize($fileName));
    header("Content-Disposition: attachment; filename=". urlencode($fileName));

    readfile($fileName);

} catch (\Exception $e){
    throw new \Exception($e->getMessage(), 500);
}

function generateRandomString($length = 20) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[random_int(0, $charactersLength - 1)];
    }
    return $randomString;
}
