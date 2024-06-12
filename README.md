
## Desafio Técnico para Desenvolvedor(a) Backend PHP Pleno

Este projeto tem como objetivo resolver de maneira simples e eficiente os desafios técnicos enfrentados por desenvolvedores PHP backend de nível pleno. A seguir, apresentamos um passo a passo para sua utilização.
  

### Instalação

Passo a passo de instalação do projeto.

Instalação:

		composer install && composer post-install

Migrar banco:

		composer migrate && composer seed

## Configurações

  

Esse projeto guarda suas configurações em variáveis de ambiente. Por tanto, fazendo uso de um arquivo ```.env``` para guardar essas informações.

  

O comando ```composer post-install``` faz uma versão desse arquivo para configurar as informações de banco, versão e ambiente e etc.
  

>Por padrão o projeto cria um sqlite mas pode-se configurar o banco no arquivo ```.env```

  

## Executar testes

De forma bem simples para iniciar os testes basta usar o comando:

		composer test

#### Iniciar servidor

		php -S localhost:8080 -t public/

## Rotas do Projeto

## Remsumo

<ol>
	<li><a href="#Products">Produtos</a></li>
	<ul>
		<li><a href="#Listar produtos">listar</a></li>
		<li><a href="#Ver produto">ver</a></li>
		<li><a href="#Criar produto">criar</a></li>
		<li><a href="#Alterar Produto">alterar</a></li>
		<li><a href="#Remover Produto">remover</a></li>
	</ul>
	<li><a href="#Categories">Categorias</a></li>
	<ul>
		<li><a href="#Listar categorias">listar</a></li>
		<li><a href="#Ver categoria">ver</a></li>
		<li><a href="#Criar categoria">criar</a></li>
		<li><a href="#Alterar categoria">alterar</a></li>
		<li><a href="#Remover categoria">remover</a></li>
	</ul>
	<li><a href="#Orders"> Pedidos</a></li>
	<ul>
		<li><a href="#Adicionar pedido">adicionar</a></li>
		<li><a href="#Ver pedido">ver</a></li>
		<li><a href="#Criar pedido">criar</a></li>
	</ul>
</ol>

### Rotas do desafio

O ponto principal solicitado seriam formas inteligentes de fazer um pedido. Nesse caso o sistema deve retornar valores como: ``taxas - fee``, ``valor bruto - gross_value``, ``valor líquido - net_value``.

A rotas a que se aplica essa regra são:

<a href="#Criar pedidos ">Criar Pedido</a>. Essa rota é responsável por iniciar a instancia de pedido.

<a href="#Adicionar pedidos">Adicionar Produto</a>. Essa rota é responsável por adicionar produtos ao pedido

<a href="#Ver Pedidos">Ver Pedido</a>. Essa rota é responsável por mostrar os valores, assim como taxas e outros cáculos.

É importante informar que os pedidos que cada as taxas dos pedidos estão ligadas as categorias dos produtos sendo:
<ul>
	<li>Notebooks: 6%</li>
	<li>Smart Phones: 8%</li>
	<li>Eletrodomésticos: 10%</li>
</ul>

#### Produtos:
  

#### Listar produtos

| GET | ``/products/`` | no body |
| -------- | ------- | ------- |

####

| Response | 200 |
| ------ | ---- |

```json

{
	"data": [
	{
		"id":  60,
		"name":  "Aspirador de Pó Philips",
		"price":  800,
		"category_id":  3,
		"deleted_at":  null,
		"created_at":  "2024-06-11T18:30:02.000000Z",
		"updated_at":  "2024-06-11T18:30:02.000000Z",
		"fee":  80,
		"net_value":  880,
		"category": {
			"id":  3,
			"name":  "Eletrodomésticos",
			"deleted_at":  null,
			"fee":  10,
			"created_at":  "2024-06-11T18:22:37.000000Z",
			"updated_at":  "2024-06-11T18:22:37.000000Z"
			}
		},
... ]

}

  

```

#### Ver produto
--------------


| GET | ``/products/{id}`` | no body |
| -------- | ------- | ------- |

####

| Response | 200 |
| ------ | ---- |

  

```json

{
	"data": {
		"id":  60,
		"name":  "Aspirador de Pó Philips",
		"price":  800,
		"category_id":  3,
		"deleted_at":  null,
		"created_at":  "2024-06-11T18:30:02.000000Z",
		"updated_at":  "2024-06-11T18:30:02.000000Z",
		"fee":  80,
		"net_value":  880,
		"category": {
			"id":  3,
			"name":  "Eletrodomésticos",
			"deleted_at":  null,
			"fee":  10,
			"created_at":  "2024-06-11T18:22:37.000000Z",
			"updated_at":  "2024-06-11T18:22:37.000000Z"
			}
		},
}

```

#### Criar produto
--------------

| POST | ``/products/`` | form urlencoded |
| -------- | ------- | ------- |

####

| Form | -- |
|------|----|
| name | notebook acer |
| price | 4000 |
| category_id | 1 |

####

| Response | 201 |
| ------ | ------ |


```json

{

	"data": {
		"id":  60,
		"name":  "Aspirador de Pó Philips",
		"price":  800,
		"category_id":  3,
		"deleted_at":  null,
		"created_at":  "2024-06-11T18:30:02.000000Z",
		"updated_at":  "2024-06-11T18:30:02.000000Z",
		"fee":  80,
		"net_value":  880,
		"category": {
			"id":  3,
			"name":  "Eletrodomésticos",
			"deleted_at":  null,
			"fee":  10,
			"created_at":  "2024-06-11T18:22:37.000000Z",
			"updated_at":  "2024-06-11T18:22:37.000000Z"
			}
		},
}

  

```

--------------

#### Alterar produto


| PUT | ``/products/{id}`` | form urlencoded |
| -------- | ------- | ------- |

####

| Form | -- |
|------|----|
| name | notebook acer1 |
| price | 4000 |
| category_id | 1 |

####

| Response | 201 |
| ------ | ------ |


```json

{
	"data": {
		"id":  60,
		"name":  "Aspirador de Pó Philips",
		"price":  800,
		"category_id":  3,
		"deleted_at":  null,
		"created_at":  "2024-06-11T18:30:02.000000Z",
		"updated_at":  "2024-06-11T18:30:02.000000Z",
		"fee":  80,
		"net_value":  880,
		"category": {
			"id":  3,
			"name":  "Eletrodomésticos",
			"deleted_at":  null,
			"fee":  10,
			"created_at":  "2024-06-11T18:22:37.000000Z",
			"updated_at":  "2024-06-11T18:22:37.000000Z"
			}
		},
} 

```

#### Remover produto

--------------

| DELETE | ``/products/{id}`` | no body |
| -------- | ------- | ------- |

####

| Response | 200 |
| ------ | ---- |

  

```json

{
	"data":"product deleted successfully"
}
```

--------------

#### Categories:

#### Listar categorias


| GET | ``/categories/`` | no body |
| -------- | ------- | ------- |

####

| Response | 200 |
| ------ | ---- |

  

```json

{
	"data": [
		{
			"id": 1,
			"name": "Notebooks",
			"deleted_at": null,
			"fee": 6,
			"created_at": "2024-06-11T14:29:41.000000Z",
			"updated_at": "2024-06-11T14:29:41.000000Z"
		},
... ]
}

```

--------------

#### Ver categoria

| GET | ``/categories/{id}`` | no body |
| -------- | ------- | ------- |

####

| Response | 200 |
| ------ | ---- | 

```json

{
	"data": {
		"id": 1,
		"name": "Notebooks",
		"deleted_at": null,
		"fee": 6,
		"created_at": "2024-06-11T14:29:41.000000Z",
		"updated_at": "2024-06-11T14:29:41.000000Z"
	}
}

```

--------------

#### Criar categoria

| POST | ``/categories/`` | form urlencoded |
| -------- | ------- | ------- |

####

| Form | -- |
|------|----|
| name | Notebooks |
| fee | 10 |

####

| Response | 201 |
| ------ | ------ |
```json

{
	"data": {
		"id": 1,
		"name": "Notebooks",
		"deleted_at": null,
		"fee": 6,
		"created_at": "2024-06-11T14:29:41.000000Z",
		"updated_at": "2024-06-11T14:29:41.000000Z"
	}
}

```

--------------

#### Alterar categoria

| PUT | ``/categories/{id}`` | form urlencoded |
| -------- | ------- | ------- |

####

| Form | -- |
|------|----|
| name | Notebooks |
| fee | 20 |

####

| Response | 201 |
| ------ | ------ |

```json

{
	"data": {
		"id": 1,
		"name": "Notebooks",
		"deleted_at": null,
		"fee": 6,
		"created_at": "2024-06-11T14:29:41.000000Z",
		"updated_at": "2024-06-11T14:29:41.000000Z"
	}
}

```

--------------

#### Remover categoria

| DELETE | ``/categories/{id}`` | no body |
| -------- | ------- | ------- |

####

| Response | 200 |
| ------ | ---- |

```json

{
	"data":"category deleted successfully"
}
```

--------------

## Orders

#### Criar pedido

| POST | ``/orders/`` | no body |
| -------- | ------- | ------- |

####

| Response | 200 |
| ------ | ---- |

```json
{
	"data": {
		"id": 12,
		"updated_at": "2024-06-11T14:59:57.000000Z",
		"created_at": "2024-06-11T14:59:57.000000Z"
	}
}
```

--------------

#### Adicionar pedido
| POST | ``/orders/add/`` | form urlencoded |
| -------- | ------- | ------- |
####

| Form | -- |
|------|----|
| product_id | 3 |
| order_id | 1 |

####

| Response | 200 |
| ------ | ---- |

```json
{
	"data": {
		"product": {
			"id": 3,
			"name": "Notebook Lenovo Ideapad",
			"price": "3200",
			"category_id": 1,
			"deleted_at": null,
			"created_at": "2024-06-11T09:45:49.000000Z",
			"updated_at": "2024-06-11T09:45:49.000000Z",
			"fee": 192,
			"net_value": 3392,
			"category": {
				"id": 1,
				"name": "Notebooks",
				"deleted_at": null,
				"fee": 6,
				"created_at": "2024-06-11T09:45:49.000000Z",
				"updated_at": "2024-06-11T09:45:49.000000Z"
			}
		},
		"order": {
			"id": 1,
			"created_at": "2024-06-11T12:45:55.000000Z",
			"updated_at": "2024-06-11T12:45:55.000000Z"
		}
	}
}
```

--------------
#### Ver pedido
| GET | ``/orders/{id}`` | no body |
| -------- | ------- | ------- |

####

| Response | 200 |
| ------ | ---- |

```json
{
	"data": {
		"fee": "R$ 954,00",
		"net_value": "R$ 16.854,00",
		"gross_value": "R$ 15.900,00",
		"amount": 5
	}
}
```

--------------


## Dependencias

<ul>
	<li>PHP 8.x</li>
	<li>Composer 2.x</li>
	<li>sqlite3 ou mysql</li>
	<li>robmorgan/phinx - 0.16.</li>
	<li>psr/container - 2.x</li>
	<li>ramsey/collection - 2.x</li>
	<li>illuminate/database - 11.1</li>
	<li> guzzlehttp/guzzle - 7.x</li>
<ul>

