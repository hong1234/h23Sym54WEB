<?php
namespace App\Controller; 

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

use App\Service\TemplateService;
use App\Service\FileUpload;
use App\Dao\TemplateDao;

/**
 *
 * @Route(path="/support")
 */
class MailTemplateController extends AbstractController 
{
    private $tempDao;
    private $templateService;
    
    public function __construct(TemplateDao $tempDao, TemplateService $templateService)
    {
        $this->tempDao = $tempDao;
        $this->templateService = $templateService;
    }

    // public function __construct(TemplateService $templateService)
    // {
    //     // $this->tempDao = $tempDao;
    //     $this->templateService = $templateService;
    // }

    /**
     * @Route("/template/list", name="template_list")
     */
    public function templateList()
    {
        $rows = $this->templateService->templatesByCategory2();
        return $this->render('temp/list.html.twig', [
            'dataSet' => $rows
        ]);
    }

    /**
     * @Route("/template/new", name="template_new")
     */
    public function templateNew(Request $request, FileUpload $fileUpload)
    {
        $templatename = '';
        $template = '';
        $dokument = '';

        $error = '';

        if ($request->isMethod('POST') && $request->request->get('savebutton')) {
            
            //post parameters
            $safePost = $request->request;
            // var_dump($safePost); var_dump($_FILES['dokument']); exit;

            $templatename = $safePost->get('templatename');
            $template     = $safePost->get('template');

            //validation
            // $error = $validator->isValidStatisticUserInput($safePost);
            if(preg_replace('/\s+/', '', $templatename) == ''){
                $error = $error."Feld 'templatename' darf nicht leer sein ---";
            }

            if(preg_replace('/\s+/', '', $template) == ''){
                $error = $error."Feld 'template' darf nicht leer sein ---";
            }

            // file upload
            if ($error == '') {
                $inputField = 'dokument';
                $doc_dir    = 'C:/PHPtest/img_depo'; // '/var/www/html/dokumente/ivd24';
                $dokument = $fileUpload->fileUpload($inputField, $doc_dir);
            }

            if ($error == '') {
                $this->templateService->insertTemplate($templatename, $template, $dokument);
                return $this->redirectToRoute('template_list', [
                    //  'paramName' => 'value'
                ]);
            } 

        }

        return $this->render('temp/new.html.twig', [ 
            'templatename' => $templatename,
            'template'     => $template,
            // 'dokument'     => $dokument,
            'error'        => $error,
            'briefanrede'  => '{{briefanrede}}',
            'anrede'       => '{{anrede}}',
            'vorname'      => '{{vorname}}',
            'nachname'     => '{{nachname}}',
            'user_id'      => '{{user_id}}',
            'anmeldelink'  => '{{anmeldelink}}'
        ]);

    }

    /**
     * @Route("/template/{tempid}/delete", name="template_delete", requirements={"tempid"="\d+"})
     */
    public function templateDelete($tempid)
    {
        $doc_dir = 'C:/PHPtest/img_depo'; // '/var/www/html/dokumente/ivd24/';
        $dokument1 = $this->templateService->getTemplateById($tempid)['document_path'];
        if(strlen($dokument1)>0){ // delete aktuelle Doc-Datei
            unlink($doc_dir.'/'.$dokument1);
        }
        
        $this->tempDao->deleteTemplate([
            'template_id' => $tempid
        ]);

        return $this->redirectToRoute('template_list', [
            //  'paramName' => 'value'
        ]);
    }

    /**
     * @Route("/template/{tempid}/edit", name="template_edit", requirements={"tempid"="\d+"})
     */
    public function templateEdit($tempid, Request $request, FileUpload $fileUpload) 
    {
        $templatename = '';
        $template = '';
        $dokument1 = '';
        $error = '';

        if ($request->isMethod('POST') && $request->request->get('savebutton')) {
            //post parameters
            $safePost = $request->request;
            // var_dump( $safePost); exit;

            $templatename = $safePost->get('templatename');
            $template     = $safePost->get('template');
            $dokument1    = $safePost->get('dokument1');

            //validation
            // $error = $validator->isValidStatisticUserInput($safePost);
            if(preg_replace('/\s+/', '', $templatename) == ''){
                $error = $error."Feld 'templatename' darf nicht leer sein ---";
            }

            if(preg_replace('/\s+/', '', $template) == ''){
                $error = $error."Feld 'template' darf nicht leer sein ---";
            }
            // file upload
            if ($error == '') {

                $inputField = 'dokument';
                $doc_dir = 'C:/PHPtest/img_depo'; // '/var/www/html/dokumente/ivd24';
                $dokument = $fileUpload->fileUpload($inputField, $doc_dir);

                if($dokument !== ''){
                    if(strlen($dokument1)>0){ // delete current Doc-Datei
                        unlink($doc_dir.'/'.$dokument1);
                    }
                    $dokument1 = $dokument; // neue Doc-Datei
                }
            }

            if ($error == '') {
                $this->templateService->updateTemplate($tempid, $templatename, $template, $dokument1);
                return $this->redirectToRoute('template_list', [
                    //  'paramName' => 'value'
                ]);
            }

        }

        if ($request->isMethod('GET')) {
            $temp = $this->templateService->getTemplateById($tempid);
            $templatename = $temp['titel'];
            $template = $temp['nachricht'];
            $dokument1 = $temp['document_path'];
        }

        return $this->render('temp/edit.html.twig', [
            'template_id' => $tempid,
            'templatename'=> $templatename,
            'template'    => $template,
            'dokument1'   => $dokument1,
            'error'       => $error,
            'briefanrede' => '{{briefanrede}}',
            'anrede'      => '{{anrede}}',
            'vorname'     => '{{vorname}}',
            'nachname'    => '{{nachname}}',
            'user_id'     => '{{user_id}}',
            'anmeldelink' => '{{anmeldelink}}'
        ]);
    }
}