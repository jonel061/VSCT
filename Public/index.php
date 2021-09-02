<?php 
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
use Slim\Views\PhpRenderer;

require '../vendor/autoload.php';
/**
 * @OA\Info(title="Proiect_pw", version="2.0")
 */


$app = AppFactory::create();
$app->setBasePath("/Proiect_pw/Public");
$app->addBodyParsingMiddleware();


$app->get('/', function ( $request,  $response, $args) {
   
    $renderer = new PhpRenderer('../Html');
    return $renderer->render($response, "home.html",$args);
    });

$app->get('/Aes', function ( $request,  $response, $args) {

    $renderer = new PhpRenderer('../Html');
    return $renderer->render($response, "Aes.php",$args);
    });

$app->post('/Aes', function ( $request,  $response, $args) {

    $renderer = new PhpRenderer('../Html');
    return $renderer->render($response, "Aes.php",$args);
    });
 
    
$app->get('/PseudocodeAes', function ( $request,  $response, $args) {

    $renderer = new PhpRenderer('../Html');
    return $renderer->render($response, "PseudoCodeAes.html",$args);
    });

$app->get('/PseudocodeAesDecriptare', function ( $request,  $response, $args) {

$renderer = new PhpRenderer('../Html');
return $renderer->render($response, "PseudoCodeAesDecriptare.html",$args);
});   

$app->get('/Caesar', function ( $request,  $response, $args) {

$renderer = new PhpRenderer('../Html');
return $renderer->render($response, "cesar.php",$args);
return $response;
});
        
$app->post('/Caesar', function ( $request,  $response, $args) {
$renderer = new PhpRenderer('../Html');
return $renderer->render($response, "cesar.php",$args);
return $response;
});


$app->get('/rezultat_caesar', function ( $request,  $response, $args) {

$renderer = new PhpRenderer('../Html');
return $renderer->render($response, "rezultat_caesar.php",$args);
return $response;
});

$app->post('/rezultat_caesar', function ( $request,  $response, $args) {
$renderer = new PhpRenderer('../Html');
return $renderer->render($response, "rezultat_caesar.php",$args);
return $response;
});        

$app->get('/download', function ( $request,  $response, $args) {

$renderer = new PhpRenderer('../Service');
return $renderer->render($response, "downoload.php",$args);
return $response;
});  

$app->get('/upload', function ( $request,  $response, $args) {
    $renderer = new PhpRenderer('../Service');
    return $renderer->render($response, "upload.php",$args);
    return $response;
    });  
    
$app->post('/upload', function ( $request,  $response, $args) {
$renderer = new PhpRenderer('../Service');
return $renderer->render($response, "upload.php",$args);
return $response;
});  


    $app->post('/addUser', function ( $request,  $response, $args) {
        $renderer = new PhpRenderer('../Html/Admin');
        return $renderer->render($response, "addUser.php",$args);
        return $response;
        });  
    
     
    $app->get('/addUser', function ( $request,  $response, $args) {
        $renderer = new PhpRenderer('../Html/Admin');
        return $renderer->render($response, "addUser.php",$args);
        return $response;
        });  
    
        
$app->get('/login', function ( $request,  $response, $args) {

    $renderer = new PhpRenderer('../Html/Admin');
    return $renderer->render($response, "login.php",$args);
    return $response;
    });  
    
$app->post('/login', function ( $request,  $response, $args) {

$renderer = new PhpRenderer('../Html/Admin');
return $renderer->render($response, "login.php",$args);
return $response;
});  
$app->get('/register', function ( $request,  $response, $args) {

    $renderer = new PhpRenderer('../Html/Admin');
    return $renderer->render($response, "register.php",$args);
    return $response;
    });  
    
$app->post('/register', function ( $request,  $response, $args) {

$renderer = new PhpRenderer('../Html/Admin');
return $renderer->render($response, "register.php",$args);
return $response;
});  
                          
       
$app->get('/index', function ( $request,  $response, $args) {
$renderer = new PhpRenderer('../Html/Admin');
return $renderer->render($response, "index.php",$args);
return $response;
}); 
       
$app->post('/index', function ( $request,  $response, $args) {
    $renderer = new PhpRenderer('../Html/Admin');
    return $renderer->render($response, "index.php",$args);
    return $response;
    });  
    

$app->post('/profile', function ( $request,  $response, $args) {

$renderer = new PhpRenderer('../Html/Admin');
return $renderer->render($response, "profile.php",$args);
return $response;
});  
                    
    
$app->get('/profile', function ( $request,  $response, $args) {
$renderer = new PhpRenderer('../Html/Admin');
return $renderer->render($response, "profile.php",$args);
return $response;
});  
$app->post('/changePassword', function ( $request,  $response, $args) {
    $renderer = new PhpRenderer('../Html/Admin');
    return $renderer->render($response, "changepass.php",$args);
    return $response;
    });  
$app->get('/changePassword', function ( $request,  $response, $args) {
    $renderer = new PhpRenderer('../Html/Admin');
    return $renderer->render($response, "changepass.php",$args);
    return $response;
    });  

$app->get('/Intrebari', function ( $request,  $response, $args) {
$renderer = new PhpRenderer('../Html');
return $renderer->render($response, "Intrebari.php",$args);
return $response;
});     
$app->post('/Intrebari', function ( $request,  $response, $args) {
$renderer = new PhpRenderer('../Html');
return $renderer->render($response, "Intrebari.php",$args);
return $response;
}); 


$app->get('/VizualizareIntrebari', function ( $request,  $response, $args) {
    $renderer = new PhpRenderer('../Html/Admin');
    return $renderer->render($response, "vizualizare_intrebari.php",$args);
    return $response;
    }); 
    
    

/**
 * @OA\Get(
 *     path="/Proiect_pw/Public/Users", tags = {"Users"},
 *   @OA\Response  (response="200", description="Success"),
 *   @OA\Response  (response="404", description="Not Found")
 * )
 */
$app->get('/Users', function($request, $response, $args) {
    $pdo = new PDO('mysql:host=localhost;port=3306;dbname=Admin', 'root', '');
    $statement = $pdo->prepare("SELECT * FROM tbl_users");
    $statement->execute();
    $users = $statement->fetchAll(PDO::FETCH_ASSOC);
    $users = json_encode($users);
    $response->getBody()->write($users);
    return $response->withHeader('Content-Type', 'application/json')
    ->withStatus(200);
});    

    /**
     * @OA\Get(
     *     path="/Proiect_pw/Public/user/{id}" ,tags={"user"},
     *     description="Returns a enquiry based on a single ID, if the user does not have access to the enquiry",
     *     operationId="findPetById",
     *     @OA\Parameter(
     *         description="ID of enquiry to fetch",
     *         in="path",
     *         name="id",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *             format="int64",
     *         )
     *     ),
     *     @OA\Response  (response="200", description="Success"),
     *      @OA\Response  (response="404", description="Not Found")
     * )
     * */
    $app->get('/user/{id}', function($request, $response, $args) {
        $pdo = new PDO('mysql:host=localhost;port=3306;dbname=Admin', 'root', '');
        $statement= $pdo->prepare("SELECT name FROM tbl_users WHERE id=:id UNION  SELECT username FROM tbl_users WHERE id=:id  UNION SELECT email FROM tbl_users WHERE id=:id
        UNION SELECT mobile FROM tbl_users WHERE id=:id");
        $statement->bindValue(":id", $args['id']);
        $statement->execute();
        $all= $statement->fetchAll(PDO::FETCH_COLUMN);
        //var_dump($users);
        if(empty($all)){
            //$response->withStatus(400); // wrong
            return $response->withStatus(400);
        }
            
        $response->withStatus(200);
        
        $response->getBody()->write(json_encode($all));
        //echo $enunt_intrebare[0];
        return $response->withHeader('Content-Type', 'application/json');
    });

    /**
     *  @OA\Post(
    *     path="/Proiect_pw/Public/add", tags={"New user"},
    *   @OA\RequestBody(
    *      @OA\MediaType(
    *              mediaType = "multipart/form-data",
 *          @OA\Schema(required = {"name","username", "email","password","mobile","roleid"}, 
    *          @OA\Property(property = "name", type = "string",),
    *          @OA\Property(property = "username", type = "string",),
    *          @OA\Property(property = "email", type = "email",),
    *         @OA\Property(property = "password", type = "password",),
    *           @OA\Property(property = "mobile", type = "string",),
    *          @OA\Property(property = "roleid", type = "integer",),
    * 
    *                                            
    *              )
    *      )
    * ),
    *   @OA\Response  (response="200", description="Success"),
    *   @OA\Response  (response="400", description="Bad Request")
    * )
    */

    $app->post('/add', function($request,$response,$argc){
        $pdo = new PDO('mysql:host=localhost;port=3306;dbname=admin','root','');
        
        if ($_SERVER['REQUEST_METHOD']==='POST'&&isset($_POST['name'],$_POST['username'],$_POST['email'],$_POST['password'],$_POST['mobile'],$_POST['roleid'])){
        $name=$_POST['name'];       
        $username=$_POST['username']; 
        $email=$_POST['email'];
        $password=$_POST['password'];  
        $mobile=$_POST['mobile']; 
        $roleid=$_POST['roleid'];   
        }
        
        $statement = $pdo -> prepare("INSERT INTO tbl_users (name,username,email,password,mobile,roleid )
        VALUES(:name,:username,:email,:password,:mobile,:roleid )");
        $statement -> bindValue(':name',$name);            
        $statement -> bindValue(':username',$username);
        $statement -> bindValue(':email',$email);
        $statement -> bindValue(':password',$password);
        $statement -> bindValue(':mobile', $mobile);
        $statement -> bindValue(':roleid', $roleid);
        $statement -> execute();
        $response->getBody()->write(json_encode(['success' => true]));
        return $response->withHeader('Content-Type', 'application/json')
        ->withStatus(200);
        });
/**
 * @OA\Put(
*     path="/Proiect_pw/Public/updateUser", tags = {"Update user"},
*   @OA\RequestBody(
*      @OA\MediaType(
*          mediaType = "application/json",
*          @OA\Schema(required = {"id","name","username", "email","password","mobile","roleid"}, 
*          @OA\Property(property = "id", type = "integer"),
*          @OA\Property(property = "name", type = "string",),
*          @OA\Property(property = "username", type = "string",),
*          @OA\Property(property = "email", type = "string",),
*          @OA\Property(property = "password", type = "string",),
*          @OA\Property(property = "mobile", type = "string",),
*          @OA\Property(property = "roleid", type = "integer",),
*                                            
*              )
*      )
* ),
*   @OA\Response  (response="200", description="Success"),
*   @OA\Response  (response="400", description="Bad Request")
 * )
 */
$app->put('/updateUser', function($request,$response,$argc){
    $pdo = new PDO('mysql:host=localhost;port=3306;dbname=admin','root','');

    $parametrii=$request->getParsedBody();
    $name= $parametrii['name'];       
    $username= $parametrii['username']; 
    $email= $parametrii['email'];
    $password= $parametrii['password'];  
    $mobile= $parametrii['mobile']; 
    $roleid= $parametrii['roleid']; 
    $id=$parametrii['id'];  
   $statement = $pdo -> prepare("UPDATE tbl_users SET  name=:name,username=:username,email=:email,password=:password,mobile=:mobile,roleid=:roleid WHERE id=:id" );
   $statement -> bindValue(':id', $id);
   $statement -> bindValue(':name',$name);            
   $statement -> bindValue(':username',$username);
   $statement -> bindValue(':email',$email);
   $statement -> bindValue(':password',$password);
   $statement -> bindValue(':mobile', $mobile);
   $statement -> bindValue(':roleid', $roleid);
    $statement -> execute();
    $response->getBody()->write(json_encode(['success' => true]));
    return $response->withHeader('Content-Type', 'application/json')
    ->withStatus(200);
});
/**
     * @OA\Delete(
     *     path="/Proiect_pw/Public/User/{id}" ,tags={"User"},
     * @OA\RequestBody(
     *      @OA\MediaType(
     *          mediaType = "application/json",
     *          @OA\Schema(required = {"id"}, 
     *          @OA\Property(property = "id", type = "integer", format = "int64"),
     *                                            
     *              )
     *      )
     * ),
     *     @OA\Response  (response="200", description="Success"),
     *      @OA\Response  (response="404", description="Not Found")
     * )
     */

    $app->delete('/User/{id}', function($request, $response, $args) {
        $pdo = new PDO('mysql:host=localhost;port=3306;dbname=admin', 'root', '');
        $id= $request->getParsedBody();
        $statement= $pdo->prepare("DELETE tbl_users.* FROM tbl_users WHERE tbl_users.id=:id");
        $statement->bindValue(':id',$id['id']);
        $statement->execute();
        if(empty($statement)){
        //$response->withStatus(400); // wrong
        return $response->withStatus(400);
        }
        $response->withStatus(200);
        $response->getBody()->write(json_encode(['success' => true]));
        return $response->withHeader('Content-Type', 'application/json');
    });
    
/**
 * @OA\Get(
 *     path="/Proiect_pw/Public/Intrebarii", tags = {"Intrebarii"},
 *   @OA\Response  (response="200", description="Success"),
 *   @OA\Response  (response="404", description="Not Found")
 * )
 **/
$app->get('/Intrebarii', function($request, $response, $args) {
    $pdo = new PDO('mysql:host=localhost;port=3306;dbname=Admin', 'root','');
    $statement = $pdo->prepare("SELECT * FROM intrebari ");
    $statement->execute();
    $intrebari= $statement->fetchAll(PDO::FETCH_ASSOC);
    $intrebari = json_encode($intrebari);
    $response->getBody()->write($intrebari);
    return $response->withHeader('Content-Type', 'application/json')
    ->withStatus(200);
});    
/**
     * @OA\Delete(
     *     path="/Proiect_pw/Public/intrebare/{id}" ,tags={"intrebare"},
     * @OA\RequestBody(
     *      @OA\MediaType(
     *          mediaType = "application/json",
     *          @OA\Schema(required = {"id"}, 
     *          @OA\Property(property = "id", type = "integer", format = "int64"),
     *                                            
     *              )
     *      )
     * ),
     *     @OA\Response  (response="200", description="Success"),
     *      @OA\Response  (response="404", description="Not Found")
     * )
     */

    $app->delete('/intrebare/{id}', function($request, $response, $args) {
        $pdo = new PDO('mysql:host=localhost;port=3306;dbname=admin', 'root', '');
        $id= $request->getParsedBody();
        $statement= $pdo->prepare("DELETE intrebari.* FROM intrebari WHERE intrebari.id=:id");
        $statement->bindValue(':id',$id['id']);
        $statement->execute();
        if(empty($statement)){
        //$response->withStatus(400); // wrong
        return $response->withStatus(400);
        }
        $response->withStatus(200);
        $response->getBody()->write(json_encode(['success' => true]));
        return $response->withHeader('Content-Type', 'application/json');
    });
    
    
$app->addErrorMiddleware(true, true, true);
$app->run();
?>

