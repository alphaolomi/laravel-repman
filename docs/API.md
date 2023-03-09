# API Documentation

## Organization

-   List all organizations

    ```php
    use AlphaOlomi\Repman\Facades\Repman;

    $orgsCollection =  Repman::organizations()->list();
    ``` 

- Create organization

    ```php
    use AlphaOlomi\Repman\Facades\Repman;

    /** @var AlphaOlomi\Repman\DataObjects\Organization */
    $org =  Repman::organizations()->create('org-name');


    echo $org->id; // 1
    echo $org->name; // org-name
    echo $org->toArray(); 
    // => [
    //  "id" => "9e680010-c8ad-4d01-a04b-00a981c25548",
    //  "type" => "github-oauth",
    //  "url" => "https://github.com/alphaolomi/laracon",
    //  "name" => "alphaolomi/laracon",
    //  "latestReleasedVersion" => "no stable release",
    //  "latestReleaseDate" => "Sun Apr 03 2022 13:15:56 GMT+0200",
    //  "description" => "LaraCon TZ 2022 Demo",
    //  "lastSyncAt" => "Fri Jun 03 2022 09:38:42 GMT+0200",
    //  "lastSyncError" => "",
    //  "webhookCreatedAt" => "Fri Jun 03 2022 09:38:39 GMT+0200",
    //  "isSynchronizedSuccessfully" => true,
    //  "scanResultStatus" => "error",
    //  "scanResultDate" => "Mon Sep 19 2022 10:00:32 GMT+0200",
    //  "lastScanResultContent" => [
    //  "exception" => [
    //      "RuntimeException" => "Version 9999999-dev for package alphaolomi/laracon not found",
    //      ],
    //  ],
    //  "keepLastReleases" => 0,
    //  "enableSecurityScan" => true,
    // ]
    ```

## Packages

-   List all packages

    ```php
    use AlphaOlomi\Repman\Facades\Repman;

    $packagesCollection =  Repman::packages()->list();
    ```

-   Add package

    ```php
    use AlphaOlomi\Repman\Facades\Repman;

    /** @var AlphaOlomi\Repman\DataObjects\Package */
    $package =  Repman::packages('my-org')->add([
        'repository'=>'alphaolomi/laracon',
        'type'=>'github',
        'keepLastReleases'=>0
    ]);
    ```

-   Update package

    ```php
    use AlphaOlomi\Repman\Facades\Repman;

    /** @var AlphaOlomi\Repman\DataObjects\Package */
    $package =  Repman::packages('my-org')->update('my-package', [
        'url'=>'http://my-cool-package.io',
        'type'=>'github',
        'keepLastReleases'=>0
    ]);

    $package->toString();
    ```

-   Synchronize package

    ```php
    use AlphaOlomi\Repman\Facades\Repman;

    Repman::packages('my-org')->sync('my-package');
    ```

-   Remove package

    ```php
    use AlphaOlomi\Repman\Facades\Repman;


    Repman::packages('my-org')->remove('my-package');
    ```

## Tokens

-   List all tokens

    ```php
    use AlphaOlomi\Repman\Facades\Repman;

    $tokensCollection =  Repman::tokens('my-org')->list();

    $tokenArray =  $tokensCollection->all();
    ```

-   Generate token

    ```php
    use AlphaOlomi\Repman\Facades\Repman;

    /** @var AlphaOlomi\Repman\DataObjects\Token */
    $token =  Repman::tokens('my-org')->generate('my-token');
    ```

-   Regenerate token

    ```php
    use AlphaOlomi\Repman\Facades\Repman;

    /** @var AlphaOlomi\Repman\DataObjects\Token */
    $token =  Repman::tokens('my-org')->regenerate('A1A1A1A1A1A1A1A1A1A1');
    ```

-   Delete token

    ```php
    use AlphaOlomi\Repman\Facades\Repman;

    Repman::tokens('my-org')->delete('A1A1A1A1A1A1A1A1A1A1');
    ```
