<?php
 /*
 *  @author    Warllencs.
 *  @license   http://www.apache.org/licenses/LICENSE-2.0
 */
class UrlAmigavel
{
	//RETORNA TODOS OS CAMPOS DA URL OU UMA POSICAO ESPECIFICA.
	public static function campo_url($posicao = null)
	{
		//pega o caminho inteiro
		$total_de_barras = explode("/", str_replace(strrchr($_SERVER["REQUEST_URI"], "?"), "", $_SERVER["REQUEST_URI"]));
		//pega somente os diretorios
		$barras_amigaveis = explode("/", str_replace(strrchr($_SERVER["PHP_SELF"], "?"), "", $_SERVER["PHP_SELF"]));

		// verifica se depois da ultima '/' existe  algum campo
		if($total_de_barras[count($total_de_barras) -1] == ''):
			//remove o ultimo campo se for vazio
			unset($total_de_barras[count($total_de_barras) -1]);
		endif;

		//retorna a url amigavel como array
		$retorno = array_slice($total_de_barras, count($barras_amigaveis) - 1);

		if($posicao != null || $posicao === 0):
			//retorna somente a posicao Ex:. campo_url(0) = pagina/ campo_url(1) = id
 			return $retorno[$posicao];
		else:
			return $retorno;
		endif;	
	}

	//SE FOR PASSADO O NOME DO CAMPO ELE RETORNA O VALOR DO CAMPO EX: pagina=home / se existir a pagina ele retornara home
	//SE  NAO FOR PASSADO O NOME DO CAMPO ELE RETORNA UM ARRAY: [0]home [1]produt [2]22 [3]
	public static function url_get($campo = null)
	{

		 if($campo != null):
		 	if(!empty($_GET[$campo])):
		 		$retorno = $_GET[$campo];
		 	else:
		 		$retorno = false;
		 	endif;
		 else:
		 	if(!empty($_GET)):
		 		foreach ($_GET as $valor):
		 			$pos = strpos($valor, '/');
		 			if($pos === false):
		 				$retorno = array_values($_GET);
		 			else:
		 				$retorno = self::campo_url();
		 				break;
		 			endif;
		 		endforeach;
		 	else:
		 		$retorno = false;
		 	endif;
		 endif;
		 return $retorno;
	}

	# pode ser utilizado dentro do BASE	html
	public static function url_padrao($tipo = 'http')
	{
		$barras_amigaveis = explode("/", str_replace(strrchr($_SERVER["PHP_SELF"], "?"), "", $_SERVER["PHP_SELF"]));
		unset($barras_amigaveis[count($barras_amigaveis) -1]);
		if($barras_amigaveis[0] == "")
		{
			unset($barras_amigaveis[0]);
		}
		$tipo = !empty($tipo) ? $tipo : 'http';
		$ds  = "/";
		$n = implode($barras_amigaveis, $ds);

		if(!empty($n))
		{
			return $tipo."://".$_SERVER['SERVER_NAME'] . $ds.$n.$ds;
		}
		else
		{
			return $tipo."://".$_SERVER['SERVER_NAME'] . $ds;
		}
	}

	# concatena id mais o titulo
	public static function linkAmigavel($id,$titulo)
	{
		$de = "áàãâéêíóôõúüçÁÀÃÂÉÊÍÓÔÕÚÜÇ";
		$para = "aaaaeeiooouucAAAAEEIOOOUUC";
	    $i = array();
	    $v = array();
	    preg_match_all('/./u', $de, $i);
	    preg_match_all('/./u', $para, $v);
	    $mapa = array_combine($i[0], $v[0]);
	    return $id."-".strtolower(str_replace(" ", "-", strtr($titulo, $mapa)) );
	}

	public static function gera_htaccess($dir = null)
	{

		$arquivo = fopen($dir.".htaccess", "w");
		$htaccess = "";
		$htaccess.="RewriteEngine On"."\r\n";
		$htaccess.=	"RewriteCond %{SCRIPT_FILENAME} !-f"."\r\n";
		$htaccess.=	"RewriteCond %{SCRIPT_FILENAME} !-d"."\r\n";
		$htaccess.=	"RewriteCond $1 !^(index\.php|img|css|js|favicon\.ico|robots\.txt)"."\r\n";
		$htaccess.=	"\r\n";
		$htaccess.=	"RewriteRule ^(.*)$ index.php?indice=$1"."\r\n";
		$grava = fwrite($arquivo, $htaccess);
		fclose($arquivo);
		echo "<script>alert('um arquivo .htaccess foi gerado..')</script>";

	}

}

?>
