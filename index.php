<HTML>
    <HEAD>
        <meta http-equiv="Content-Type" content="text/html; charset=utf8">
        <script language=Javascript>
            function RunTimer(){
				setTimeout("Timer01();", 60000);
            }
			function Timer01(){
				window.location.reload();
			}
        </script>
    </HEAD>
	<Body onload=RunTimer();>	
		<?php
		header("Content-Type:text/html; charset=utf-8");
		set_time_limit(0);//無限等待
		echo '<B>jash-liao 存股-股價即時更新系統:</B><br><br>'; 
		echo '<br><br><br><br><br><br>';
		date_default_timezone_set("Asia/Taipei");
		echo '更新時間:'. date ("Y- m - d / H : i : s"); 
		$time='&t='.date ("YmdHis");
		
		echo "<font size='26' face='Arial'>";//PHP放大字體
		
		echo '<table style="font-size:22px; font-family:Arial; width:500px; border: 1px solid black; border-collapse: collapse;">';
		$fp = fopen("stock.csv", "r");
		while (($data = fgetcsv($fp, 1000, ",")) !== FALSE)
		{
			$id=$data[1];
			$name=$data[0];
			$text=file('https://tw.stock.yahoo.com/quote/'.$id);			
			foreach ($text as $line_num => $line)
			{
				if (strpos($line,'<span class="Fz(32px) Fw(b) Lh(1) Mend(16px) D(f) Ai(c)') !== false)
				{
					$replace_example00 = explode('<span class="Fz(32px) Fw(b) Lh(1) Mend(16px) D(f) Ai(c)',$line);
					$replace_example01 = str_replace(array(">","<"),'_',$replace_example00[1]);
					$replace_example02 = explode('_',$replace_example01);
					echo '<tr style="border: 1px solid black; border-collapse: collapse;">';
					echo '<td>'.$name.'[&nbsp;'.$id.'&nbsp;]&nbsp;&nbsp;&nbsp;&nbsp;'.$replace_example02[1].'</td>';
					//echo ;
					echo '</tr>';					
					break;
				}
			}
		}
		fclose($fp);
		echo '</table>';
		echo '<br>';
		echo '資料來源:每分鐘跟YAHOO要一次';
		//print_r($text);
		?>
	</Body>
<HTML> 