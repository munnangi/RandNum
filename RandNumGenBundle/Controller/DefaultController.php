<?php

namespace RandNumGenBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use RandNumGenBundle\Model\Services\GenerateRandNum;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\SubmitButton;
use Symfony\Component\HttpFoundation\Request;
use RandNumGenBundle\Model\Services\GenerateNumWord;

class DefaultController extends Controller
{
    private $randNumService;
    private $randNumWordService;
    private $num_to_word;
    private $minVal;
    private $maxVal;
    private $count_guess;
    private $num_input;
    private $num;
    private $num_away;

    /**
     * @return int
     */
    public function getMinVal()
    {
        return $this->minVal;
    }

    /**
     * @param int $minVal
     */
    public function setMinVal($minVal)
    {
        $this->minVal = $minVal;
    }

    /**
     * @return int
     */
    public function getMaxVal()
    {
        return $this->maxVal;
    }

    /**
     * @param int $maxVal
     */
    public function setMaxVal($maxVal)
    {
        $this->maxVal = $maxVal;
    }


    public function __construct($min=1, $max =10)
    {
        $this->setMinVal($min);
        $this->setMaxVal($max);
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * method to display form values and check if the guessed value matches the random
     * number generated
     */
    public function indexAction(Request $request)
    {

        $form = $this->createFormBuilder()->add('EnterGuess',IntegerType::class,array('attr'=>array('min'=>$this->minVal,'max'=>$this->maxVal)))
                ->add('countguess',HiddenType::class)
                ->getForm();

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $this->count_guess = (int)$request->request->get('form')["countguess"]+ 1;
            $this->randNumWordService = $this->get(GenerateNumWord::class);
            $this->num_to_word = $this->randNumWordService->NumtoWord($this->count_guess);
        /* Not required as the validation for the min and  max are done using html validation */
         /*   try {
                $this->num_input = $request->request->get('form')["EnterGuess"];
                if($this->num_input > $this->maxVal )
                {
                    throw new Exception('Entered value is not applicable');
                }
            }
            catch(Exception $exception)
            {
                echo $exception->getMessage();
                die();
            }*/
            $this->num_input = $request->request->get('form')["EnterGuess"];
            $this->randNumService = $this->get(GenerateRandNum::class);
            $this->num = $this->randNumService->generateNum($this->minVal, $this->maxVal);
            $this->num_away = abs($this->num - $this->num_input);
        }
        else{
            $this->count_guess = 0;
        }

        return $this->render('RandNumGenBundle:Default:render.html.twig'
       , ['form'=> $form->createView(),'randNum' =>$this->num,'num_input'=>$this->num_input,'count_guess'=>$this->count_guess,'num_to_word'=>$this->num_to_word,'num_away'=>$this->num_away]);
    }



}
