# Urlamigavel

Ajuda na criacao a criacao de urls amigaveis.

**Gera um arquivo .htaccess com as configuracoes **
> (obs. o servidor precisa conter as permissoes para gravacao )

```php
UrlAmigavel::gera_htaccess();
```
**Retorna todos os campos da url ou uma posicao especifica**

> url http://localhost/casa/quarto/mesa

```php
UrlAmigavel::campo_url();
```
> [EXIBE] Array ( [0] => casa [1] => quarto [2] => mesa )

```php
UrlAmigavel::campo_url(0);
```

> [EXIBE] casa

**Utiliza urls amigaveis ou urls comuns**

> url http://localhost/casa/quarto/mesa

```php
UrlAmigavel::url_get();
```
> [EXIBE] Array ( [0] => casa [1] => quarto [2] => mesa )

> http://localhost/index.php?imovel=casa&comodo=quarto&movel=mesa

```php
UrlAmigavel::url_get();
```
> [EXIBE] Array ( [0] => casa [1] => quarto [2] => mesa )

```php
UrlAmigavel::url_get('comodo');
```
> [EXIBE] quarto

**Insere o caminho padrao automaticamente onde os arquivos estao localizados**

```php
UrlAmigavel::url_padrao('http') ou UrlAmigavel::url_padrao('https');
```

> [EXIBE] http://localhost/ https://localhost/

> Se os arquivos estiveram no diretorio backup a url ficaria 

> [EXIBE] http://localhost/backup/ 

**Cria um link com nome do item**

> Url http://localhost/produto/5
O numero 5 refrencia um id 5

```php
UrlAmigavel::linkAmigavel('5','Loção pos Barba');	
```
> [EXIBE] http://localhost/produto/5-locao-pos-barba
