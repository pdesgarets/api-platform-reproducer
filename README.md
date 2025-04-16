# Steps to reproduce

1. Clone and `docker compose up -d`
2. 
```bash
# As an admin, create a greeting belonging to "user"
$ docker compose exec php curl -u admin:admin -k https://localhost:443/greetings -X POST -H "Content-Type:application/ld+json" --data '{"name": "hi", "ownerName": "user"}'
{"@context":"\/contexts\/Greeting","@id":"\/greetings\/1","@type":"Greeting","id":1,"name":"hi","ownerName":"user"}
```
3. 
```bash
# As the owner, try to patch the greeting name. Expected: "name" property equals "hi1". Actual: "name" property is not changed and status code is 200, which is misleading
$ docker compose exec php curl -u user:user -k https://localhost:443/greetings/1 -X PATCH -H "Content-Type:application/merge-patch+json" --data '{"name": "hi1"}'
{"@context":"\/contexts\/Greeting","@id":"\/greetings\/1","@type":"Greeting","id":1,"name":"hi"}
```
4.
```bash
# optionally, edit `Greeting.php` and replace `.?` with `.` to see that `object` is `null`
$ docker compose exec php sed -i 's/object?.ownerName/object.ownerName/' /app/src/Entity/Greeting.php
$ docker compose exec php curl -u user:user -k https://localhost:443/greetings/1 -X PATCH -H "Content-Type:application/merge-patch+json" --data '{"name": "hi1"}'
{"@context":"\/contexts\/Error","@id":"\/errors\/500","@type":"Error","title":"An error occurred","detail":"Unable to get property \u0022ownerName\u0022 of non-object \u0022object\u0022.","status":500,"type":"\/errors\/500","trace":[{"file":"\/app\/vendor\/symfony\/expression-language\/Node\/BinaryNode.php","line":105,"function":"evaluate","class":"Symfony\\Component\\ExpressionLanguage\\Node\\GetAttrNode","type":"-\u003E"},{"file":"\/app\/vendor\/symfony\/expression-language\/Node\/BinaryNode.php","line":120,"function":"evaluate","class":"Symfony\\Component\\ExpressionLanguage\\Node\\BinaryNode","type":"-\u003E"},{"file":"\/app\/vendor\/symfony\/expression-language\/ExpressionLanguage.php","line":59,"function":"evaluate","class":"Symfony\\Component\\ExpressionLanguage\\Node\\BinaryNode","type":"-\u003E"},{"file":"\/app\/vendor\/api-platform\/symfony\/Security\/ResourceAccessChecker.php","line":56,"function":"evaluate","class":"Symfony\\Component\\ExpressionLanguage\\ExpressionLanguage","type":"-\u003E"},{"file":"\/app\/vendor\/api-platform\/serializer\/AbstractItemNormalizer.php","line":460,"function":"isGranted","class":"ApiPlatform\\Symfony\\Security\\ResourceAccessChecker","type":"-\u003E"},{"file":"\/app\/vendor\/api-platform\/serializer\/AbstractItemNormalizer.php","line":444,"function":"canAccessAttribute","class":"ApiPlatform\\Serializer\\AbstractItemNormalizer","type":"-\u003E"},{"file":"\/app\/vendor\/api-platform\/serializer\/AbstractItemNormalizer.php","line":423,"function":"isAllowedAttribute","class":"ApiPlatform\\Serializer\\AbstractItemNormalizer","type":"-\u003E"},{"file":"\/app\/vendor\/symfony\/serializer\/Normalizer\/AbstractObjectNormalizer.php","line":318,"function":"getAllowedAttributes","class":"ApiPlatform\\Serializer\\AbstractItemNormalizer","type":"-\u003E"},{"file":"\/app\/vendor\/api-platform\/serializer\/AbstractItemNormalizer.php","line":238,"function":"denormalize","class":"Symfony\\Component\\Serializer\\Normalizer\\AbstractObjectNormalizer","type":"-\u003E"},{"file":"\/app\/vendor\/api-platform\/serializer\/ItemNormalizer.php","line":71,"function":"denormalize","class":"ApiPlatform\\Serializer\\AbstractItemNormalizer","type":"-\u003E"},{"file":"\/app\/vendor\/symfony\/serializer\/Debug\/TraceableNormalizer.php","line":76,"function":"denormalize","class":"ApiPlatform\\Serializer\\ItemNormalizer","type":"-\u003E"},{"file":"\/app\/vendor\/symfony\/serializer\/Serializer.php","line":240,"function":"denormalize","class":"Symfony\\Component\\Serializer\\Debug\\TraceableNormalizer","type":"-\u003E"},{"file":"\/app\/vendor\/symfony\/serializer\/Serializer.php","line":145,"function":"denormalize","class":"Symfony\\Component\\Serializer\\Serializer","type":"-\u003E"},{"file":"\/app\/vendor\/symfony\/serializer\/Debug\/TraceableSerializer.php","line":59,"function":"deserialize","class":"Symfony\\Component\\Serializer\\Serializer","type":"-\u003E"},{"file":"\/app\/vendor\/api-platform\/state\/Provider\/DeserializeProvider.php","line":92,"function":"deserialize","class":"Symfony\\Component\\Serializer\\Debug\\TraceableSerializer","type":"-\u003E"},{"file":"\/app\/vendor\/api-platform\/symfony\/Security\/State\/AccessCheckerProvider.php","line":62,"function":"provide","class":"ApiPlatform\\State\\Provider\\DeserializeProvider","type":"-\u003E"},{"file":"\/app\/vendor\/api-platform\/symfony\/Validator\/State\/ValidateProvider.php","line":32,"function":"provide","class":"ApiPlatform\\Symfony\\Security\\State\\AccessCheckerProvider","type":"-\u003E"},{"file":"\/app\/vendor\/api-platform\/symfony\/Security\/State\/AccessCheckerProvider.php","line":62,"function":"provide","class":"ApiPlatform\\Symfony\\Validator\\State\\ValidateProvider","type":"-\u003E"},{"file":"\/app\/vendor\/api-platform\/symfony\/Validator\/State\/ParameterValidatorProvider.php","line":94,"function":"provide","class":"ApiPlatform\\Symfony\\Security\\State\\AccessCheckerProvider","type":"-\u003E"},{"file":"\/app\/vendor\/api-platform\/state\/Provider\/ParameterProvider.php","line":120,"function":"provide","class":"ApiPlatform\\Symfony\\Validator\\State\\ParameterValidatorProvider","type":"-\u003E"},{"file":"\/app\/vendor\/api-platform\/state\/Provider\/ContentNegotiationProvider.php","line":51,"function":"provide","class":"ApiPlatform\\State\\Provider\\ParameterProvider","type":"-\u003E"},{"file":"\/app\/vendor\/api-platform\/symfony\/Controller\/MainController.php","line":83,"function":"provide","class":"ApiPlatform\\State\\Provider\\ContentNegotiationProvider","type":"-\u003E"},{"file":"\/app\/vendor\/symfony\/http-kernel\/HttpKernel.php","line":183,"function":"__invoke","class":"ApiPlatform\\Symfony\\Controller\\MainController","type":"-\u003E"},{"file":"\/app\/vendor\/symfony\/http-kernel\/HttpKernel.php","line":76,"function":"handleRaw","class":"Symfony\\Component\\HttpKernel\\HttpKernel","type":"-\u003E"},{"file":"\/app\/vendor\/symfony\/http-kernel\/Kernel.php","line":182,"function":"handle","class":"Symfony\\Component\\HttpKernel\\HttpKernel","type":"-\u003E"},{"file":"\/app\/vendor\/symfony\/runtime\/Runner\/Symfony\/HttpKernelRunner.php","line":35,"function":"handle","class":"Symfony\\Component\\HttpKernel\\Kernel","type":"-\u003E"},{"file":"\/app\/vendor\/autoload_runtime.php","line":29,"function":"run","class":"Symfony\\Component\\Runtime\\Runner\\Symfony\\HttpKernelRunner","type":"-\u003E"},{"file":"\/app\/public\/index.php","line":5,"function":"require_once"}],"description":"Unable to get property \u0022ownerName\u0022 of non-object \u0022object\u0022."}
```

<h1 align="center"><a href="https://api-platform.com"><img src="https://api-platform.com/images/logos/Logo_Circle%20webby%20text%20blue.png" alt="API Platform" width="250" height="250"></a></h1>

API Platform is a next-generation web framework designed to easily create API-first projects without compromising extensibility
and flexibility:

* Design your own data model as plain old PHP classes or [**import an existing ontology**](https://api-platform.com/docs/schema-generator).
* **Expose in minutes a hypermedia REST or a GraphQL API** with pagination, data validation, access control, relation embedding,
  filters, and error handling...
* Benefit from Content Negotiation: [GraphQL](https://api-platform.com/docs/core/graphql/), [JSON-LD](https://json-ld.org), [Hydra](https://hydra-cg.com),
  [HAL](https://github.com/mikekelly/hal_specification/blob/master/hal_specification.md), [JSON:API](https://jsonapi.org/), [YAML](https://yaml.org/), [JSON](https://www.json.org/), [XML](https://www.w3.org/XML/) and [CSV](https://www.ietf.org/rfc/rfc4180.txt) are supported out of the box.
* Enjoy the **beautiful automatically generated API documentation** ([OpenAPI](https://api-platform.com/docs/core/openapi/)).
* Add [**a convenient Material Design administration interface**](https://api-platform.com/docs/admin) built with [React](https://reactjs.org/)
  without writing a line of code.
* **Scaffold fully functional Progressive-Web-Apps and mobile apps** built with [Next.js](https://api-platform.com/docs/client-generator/nextjs/) (React),
[Nuxt.js](https://api-platform.com/docs/client-generator/nuxtjs/) (Vue.js) or [React Native](https://api-platform.com/docs/client-generator/react-native/)
thanks to [the client generator](https://api-platform.com/docs/client-generator/) (a Vue.js generator is also available).
* Install a development environment and deploy your project in production using **[Docker](https://api-platform.com/docs/distribution)**
and [Kubernetes](https://api-platform.com/docs/deployment/kubernetes).
* Easily add **[OAuth](https://oauth.net/) authentication**.
* Create specs and tests with **[a developer friendly API testing tool](https://api-platform.com/docs/distribution/testing/)**.

The official project documentation is available **[on the API Platform website](https://api-platform.com)**.

API Platform embraces open web standards and the
[Linked Data](https://www.w3.org/standards/semanticweb/data) movement. Your API will automatically expose structured data.
It means that your API Platform application is usable **out of the box** with technologies of
the semantic web.

It also means that **your SEO will be improved** because **[Google leverages these formats](https://developers.google.com/search/docs/guides/intro-structured-data)**.

Last but not least, the server component of API Platform is built on top of the [Symfony](https://symfony.com) framework,
while client components leverage [React](https://reactjs.org/) ([Vue.js](https://vuejs.org/) flavors are also available).
It means that you can:

* Use **thousands of Symfony bundles and React components** with API Platform.
* Integrate API Platform in **any existing Symfony, React, or Vue application**.
* Reuse **all your Symfony and JavaScript skills**, and benefit from the incredible amount of documentation available.
* Enjoy the popular [Doctrine ORM](https://www.doctrine-project.org/projects/orm.html) (used by default, but fully optional:
  you can use the data provider you want, including but not limited to MongoDB and Elasticsearch)

## Install

[Read the official "Getting Started" guide](https://api-platform.com/docs/distribution/).

## Credits

Created by [Kévin Dunglas](https://dunglas.fr). Commercial support is available at [Les-Tilleuls.coop](https://les-tilleuls.coop).
