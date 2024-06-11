
## Desafio Técnico para Desenvolvedor(a) Backend PHP Pleno

Este projeto tem como objetivo resolver de maneira simples e eficiente os desafios técnicos enfrentados por desenvolvedores PHP backend de nível pleno. A seguir, apresentamos um passo a passo para sua utilização.
  

### Instalação

Passo a passo de instalação do projeto.

composer install

composer post-install

composer migrate

composer seed

  

## Configurações

  

Esse projeto guarda suas configurações em variáveis de ambiente. Por tanto fazendo uso de um arquivo ```.env``` para guardar essas informações.

  

O comando ```composer post-install``` irá fazer uma versão desse arquivo para que possa ser configurado informações de banco, versão e ambiente de do projeto.

  

>Por padrão o projeto cria um sqlite mas pode-se configurar o banco no arquivo ```.env```

  

## Rodar tests

  

De forma bem simples para rodas os testes basta usar o comando:

  
                composer test

#### Iniciar servidor

                php -S localhost:8080 -t public/
  

## Rotas altertnativas

  

#### Produtos:

  

| GET | ``'/products/`` | no body |
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

--------------
