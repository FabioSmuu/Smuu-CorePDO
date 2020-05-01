# Repositorio de arquivos php em base mysql com conexão pdo.

[![N|Solid](https://i.imgur.com/mF9AKO0.png)](https://www.paypal.com/cgi-bin/webscr?cmd=_donations&business=fabinhoec2210@gmail.com&item_name=F%C3%A1bio&currency_code=BRL)

Aviso basico: Os arquivos reais do projetose encontra na pasta [#](/%23), o resto dos arquivos são apenas para fins de exemplos em uso.

| Este projeto contem | arquivo |
|-|-|
| Função de Login |  [session.php linha 48](%23/session.php#L48) |
| Função de Registro |  [session.php linha 86](%23/session.php#L86) |
| Função de Deslogdo |  [session.php inha 40](%23/session.php#L40) |

### Configurações:
- Configure seu banco de dados mysql no arquivo [config.php](/%23/config.php).
- Em [query.php](/%23/query.php) se entronca as funções usadas para exibição de valores.
- Na [session.php](%23/session.php) pode se configurar todas as informações de seções.
#
#
# Como Usar:
### Efetuando conexão por form:
Na linha 12 do arquivo [index.php](/index.php#L12) você irá se deparar com algo semelhante a:
```php
<?=logar('email', 'senha')?>
```
Onde  email e senha, são os campos "name" de um input dentro de uma form.
Este "logar" se trata de uma função na linha 48 do arquivo [session.php](%23/session.php#L48), que basicamente recebe os valores do campo para efetuar uma requisição post.

### Lendo informaçõs do usuario logado:
Explorando a [index.php](/painel/index.php#L16), vemos que na linha 16 exibimos o id do usuario logado.
Para isso eu usei a função "user", criada em [query.php](/%23/query.php#L27).
```php
<?=user('id')?>
```

### Entendendo a query.php
Podemos facilmente criar uma leitura direta no banco de dados usando as funções do arquivo [pdo.php](/%23/pdo.php)

Mostro claramente neste exemplo o uso da função "filtrar"e "ler".
Então o primeiro passo será criar uma função contendo os parametros relacionado as colunas de uma tabela no banco de dados por exemplo.
```php
function nome($coluna1, $coluna2)
{
    //return....
}
````
Dentro desta função, iremos puxar o valor da coluna "nome" na tabela "artigo" atraves de um id.
```php
function artigo($id)
{
    $id = filtrar($id);

    $query = ler("SELECT * FROM artigo WHERE id = '$id'");
    return $query['nome'];
    //return....
}
````
Perceba que o parametro $id teve de passar por um filtro, pois este parametro será injetado um valor de fora do banco de dados para dentro dele e isso evitará o uso de InjectSQL.

O retorno nome, foi dado diretamente no retorno da função, pois queremos jogar este valor em uma pagina php comun exibindo um paragrafo em html e para fazer isso, basca criar a leitura da seguinte forma:
```php
//arquivo exemplo.html (OBS: este arquivo não existe na documentação)
<p><?=artigo('7')?></p>
```
Basicamente "artigo" é o nome dado a nossa funão em nossa [query.php](/%23/query.php). e 7 é o id que gostariamos de imprimir em nosso paragrafo.

Por fim, aqui esta a exibição de cada função pdo do projeto:
| Funções PDO | Ação efetuado com o uso | linha |
|-|-|-|
| filtrar | Limpa strings para evitr falhas de  InjectSQL e XSS | [linha 12](/%23/pdo.php#L12) |
| executar | Executa query direto na MySQL | [linha 23](/%23/pdo.php#L23) |
| ler | Puxa o ultimo resultado da consulta | [linha 31](/%23/pdo.php#L31) |
| listar | Lista e/ou puxa resultados de consultas | [linha 36](/%23/pdo.php#L36) |
| contar | Exibe o numero de resultados em uma consutal | [linha 41](/%23/pdo.php#L41) |
| desfoque | Usa varios metodos simples para ofuscar strings | [linha 46](/%23/pdo.php#L46) |

**Obrigado pela sua atenção!**
