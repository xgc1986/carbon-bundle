# Usage

I am not good exaplining myself, and because of that I created a repository with 
some usages of my libraries

[Xgc PHP Samples](https://github.com/xgc1986/xgc-php-samples)

### Doctrine

The example has an Entity (CarbonLog), this has a field, and the type is 'carbon'.
This converts the SQL Field into a Carbon object and viceversa.

[Entity CarbonLog](https://github.com/xgc1986/xgc-php-samples/blob/master/src/AppBundle/Entity/CarbonLog.php)

```php
    /**
     * @var null|Carbon
     *
     * @ORM\Column(type="carbon")
     */
    protected $date;
    
   /**
    * @return null|Carbon
    */
   public function getDate(): ?Carbon
   {
       return $this->date;
   }

   /**
    * @param Carbon $date
    */
   public function setDate(Carbon $date): void
   {
       $this->date = $date;
   }
```

### Form

The example is compose in three parts, the first one is the controller that creates the form
, the second part receives the Carbon from the request. And the last part renders the from.

CarbonType extends DateTimeType, then you mantain CarbonType the functionalities. 

[CarbonController](https://github.com/xgc1986/xgc-php-samples/blob/master/src/AppBundle/Controller/Carbon/CarbonController.php)
```php
    /**
     * @Route("/")
     * @Method({"GET", "POST"})
     * @Template()
     */
    public function indexAction(Request $request)
    {
        $carbonModel = new CarbonLog();
        $form = $this->createFormBuilder($carbonModel, ['method' => 'POST'])
                     ->add('date', CarbonType::class)
                     ->add('send', SubmitType::class)
                     ->getForm();
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $carbonModel = $form->getData();
            return $this->redirectToRoute('app_carbon_carbon_carbon', ['date' => $carbonModel->getDate()]);
        }
        return [
            'form' => $form->createView()
        ];
    }
```

[index.html.twig](https://github.com/xgc1986/xgc-php-samples/blob/master/src/AppBundle/Resources/views/Carbon/Carbon/index.html.twig)
```twig
<html>
    <head>
        <title>Carbon sample</title>
    </head>
    <body>
        <div>Test : <a href="/carbon/21-02-1986">Redirect to /carbon/21-02-1986</a></div>
        <div>{{ form(form, {'attr': {'novalidate': 'novalidate'}}) }}</body>
    </body>
</html>
```

## ParamConverter

This example accepts a Carbon parameter in the URL

[CarbonController](https://github.com/xgc1986/xgc-php-samples/blob/master/src/AppBundle/Controller/Carbon/CarbonController.php)
```php
    /**
     * @Route("/{date}")
     * @Method("GET")
     * @Template()
     *
     * @param Carbon $date
     *
     * @return array
     */
    public function carbonAction(Carbon $date): array
    {
        $doctrine = $this->get('doctrine');
        $carbons  = $doctrine->getRepository(CarbonLog::class)->findAll();
        if (count($carbons) === 10) {
            $doctrine->getManager()->remove($carbons[0]);
        }
        $carbonLog = new CarbonLog();
        $carbonLog->setDate($date);
        $doctrine->getManager()->persist($carbonLog);
        $doctrine->getManager()->flush();
        return [
            'date' => $date,
            'log'  => $carbons
        ];
    }
```

The param accepts the followinf formats by default
* ATOM
* COOKIE
* ISO8601
* RFC822
* RFC850
* RFC1036
* RFC1123
* RFC2822
* RFC3339
* RFC3339_EXTENDED
* RFC7231
* RSS
* W3C, 
* 'Y-m-d H:i:s'
* 'd-m-Y H:i:s'
* 'd-m-Y'
* 'Y-m-d'
* 'U' (timestamp in seconds)

If the format you use is no there, you can still use custom formats
```php
    /**
     * @Route("/{date}", format="Y-m-d")
     * @Method("GET")
     * @Template()
     *
     * @param Carbon $date
     *
     * @return array
     */
    public function carbonAction(Carbon $date): array
    {
        //...
    }
```

[< Installation](./usage.md)
