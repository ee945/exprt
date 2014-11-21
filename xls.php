<?php
session_start();
require_once 'common/PHPExcel.php';
include_once ('./common/config.php');
if(!isset($_SESSION[shell])){ ?>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<script type="text/javascript">
    alert("无权备份！请先登录！");
    javascript:history.go(-1);
    </script>
    <?php
    exit;
}

$conn = mysql_connect($mydbhost, $mydbuser, $mydbpw) or die("连接错误");
@mysql_select_db($mydbname, $conn);
mysql_query("set names $mydbcharset");
$query = mysql_query("select * from `ex_record` order by rstime desc");

$sheet_title = "备份";
$todaynow=strval(date("YmdHis",time()));
$filename = "record-".$todaynow.".xls";

// 创建excel对象
$objPHPExcel = new PHPExcel();

// 文档属性
$objPHPExcel->getProperties()->setCreator("ee945")
                             ->setLastModifiedBy("ee945")
                             ->setTitle("Office 2003 XLS Backup Document")
                             ->setSubject("Office 2003 XLS Backup Document")
                             ->setDescription("Record Database Backup, generated using PHP classes.")
                             ->setKeywords("office 2003 openxml php")
                             ->setCategory("backup file");


// 表头
$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A1', '单号')
            ->setCellValue('B1', '快递公司')
            ->setCellValue('C1', '快递种类')
            ->setCellValue('D1', '内容')
            ->setCellValue('E1', '发件时间')
            ->setCellValue('F1', '打印时间')
            ->setCellValue('G1', '备注')
            ->setCellValue('H1', '收件人')
            ->setCellValue('I1', '职位')
            ->setCellValue('J1', '收件公司')
            ->setCellValue('K1', '收件电话')
            ->setCellValue('L1', '收件地址')
            ->setCellValue('M1', '收件城市')
            ->setCellValue('N1', '发件人')
            ->setCellValue('O1', '公司')
            ->setCellValue('P1', '电话')
            ->setCellValue('Q1', '地址')
            ->setCellValue('R1', '城市');

$i=2;
while ($row = mysql_fetch_array($query)){
    $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValueExplicit('A'.$i, $row[1],PHPExcel_Cell_DataType::TYPE_STRING)
                ->setCellValue('B'.$i, $row[2])
                ->setCellValue('C'.$i, $row[3])
                ->setCellValue('D'.$i, $row[4])
                ->setCellValue('E'.$i, $row[5])
                ->setCellValue('F'.$i, $row[6])
                ->setCellValueExplicit('G'.$i, $row[7],PHPExcel_Cell_DataType::TYPE_STRING)
                ->setCellValue('H'.$i, $row[8])
                ->setCellValue('I'.$i, $row[9])
                ->setCellValue('J'.$i, $row[10])
                ->setCellValueExplicit('K'.$i, $row[11],PHPExcel_Cell_DataType::TYPE_STRING)
                ->setCellValue('L'.$i, $row[12])
                ->setCellValue('M'.$i, $row[13])
                ->setCellValue('N'.$i, $row[14])
                ->setCellValue('O'.$i, $row[15])
                ->setCellValueExplicit('P'.$i, $row[16],PHPExcel_Cell_DataType::TYPE_STRING)
                ->setCellValue('Q'.$i, $row[17])
                ->setCellValue('R'.$i, $row[18]);
    $i++;
}

// sheet名称
$objPHPExcel->getActiveSheet()->setTitle($sheet_title);


// 默认sheet
$objPHPExcel->setActiveSheetIndex(0);

//设置单元格宽度
$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(12.56);
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(10.33);
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(10.33);
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(10.33);
$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(19.22);
$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(10.33);
$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(10.33);
$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(10.33);
$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(10.33);
$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(10.33);
$objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(12.56);
$objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(10.33);
$objPHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth(10.33);
$objPHPExcel->getActiveSheet()->getColumnDimension('N')->setWidth(10.33);
$objPHPExcel->getActiveSheet()->getColumnDimension('O')->setWidth(10.33);
$objPHPExcel->getActiveSheet()->getColumnDimension('P')->setWidth(12.56);
$objPHPExcel->getActiveSheet()->getColumnDimension('Q')->setWidth(10.33);
$objPHPExcel->getActiveSheet()->getColumnDimension('R')->setWidth(10.33);


// Redirect output to a client’s web browser (Excel5)
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="'.$filename.'"');
header('Cache-Control: max-age=0');
// If you're serving to IE 9, then the following may be needed
header('Cache-Control: max-age=1');
// If you're serving to IE over SSL, then the following may be needed
//header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
header ('Pragma: public'); // HTTP/1.0

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objWriter->save('php://output');
exit;

?>