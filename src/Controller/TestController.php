<?php

namespace App\Controller;

use App\Entity\Department;
use App\Entity\Intermunicipality;
use App\Repository\DepartmentRepository;
use App\Repository\IntermunicipalityRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TestController extends AbstractController
{
    #[Route('/sfdfdefer', name: 'app_test')]
    public function index(DepartmentRepository $departmentRepository): Response
    {
		$json = json_decode(file_get_contents('departements-region.json'));
		foreach ($json as $item){
			$dep = new Department();
			$dep->setName($item->dep_name);
			$dep->setCode($item->num_dep);
			$departmentRepository->add($dep, true);
		}

        return $this->render('test/index.html.twig');
    }

	#[Route('/efefef', name: 'app_test1')]
	public function index1(IntermunicipalityRepository $intermunicipalityRepository, DepartmentRepository $departmentRepository): Response
	{
		$json = json_decode(file_get_contents('intercommunalite.json'));
		foreach ($json as $item){
			$inte = new Intermunicipality();
			$inte->setName($item->name);
			$array = explode(",",$item->dep_code);
			dump($array);
			foreach ($array as $code){
				$inte->addDepartment($departmentRepository->findOneBy(['code' => $code]));
			}
			dump($inte);
			$intermunicipalityRepository->add($inte, true);
		}

		return $this->render('test/index.html.twig');
	}
}
