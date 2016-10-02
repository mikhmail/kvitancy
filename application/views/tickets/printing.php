
<?


//$htm = 'print_kvitancy.htm';
//$html  = file_get_contents($htm);
$html = strip_slashes($text->value);
$search = array(
				"[name_sc]",
				"[adres_sc]",
				"[phone_sc]",
				"[rab_sc]",
				"[site]",
				"[mail_sc]",
				"[nomer_kvitancy]",
				"[id_aparat]",
				"[id_proizvod]",
				"[model]",
				"[ser_nomer]",
				"[id_remonta]",
				"[date_priemka]",
				"[neispravnost]",
				"[vid]",
				"[komplektnost]",
				"[phone]",
				"[fam]",
				"[imya]",
				"[otch]"
				
				);
				
$data   = array(
				$sc[0]["name_sc"],
				$sc[0]["adres_sc"],
				$sc[0]["phone_sc"],
				$sc[0]["rab_sc"],
				$sc[0]["site"],
				$sc[0]["mail_sc"],
				$manufacture[0]["id_kvitancy"],
				$aparat[0]["aparat_name"],
				$proizvod[0]["name_proizvod"],
				$manufacture[0]["model"],
				$manufacture[0]["ser_nomer"],
				$manufacture[0]["name_remonta"],
				$manufacture[0]["date_priemka"],
				$manufacture[0]["neispravnost"],
				$manufacture[0]["vid"],
				$manufacture[0]["komplektnost"],
				$client[0]["phone"],
				$client[0]["fam"],
				$client[0]["imya"],
				$client[0]["otch"]
				
				);

echo $newhtml = str_replace($search, $data, $html);
?>