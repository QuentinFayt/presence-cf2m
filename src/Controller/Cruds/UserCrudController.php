<?php

namespace App\Controller\Cruds;

use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserCrudController extends AbstractController
{
    #[Route('/admin/create/users', name: 'app_admin_create_users')]
    public function createUsers(Request $request): Response
    {
        if ($request->isMethod("POST")) {
            $user = new User();
            $tableau = [
                "username" => $request->request->get("username"),
                "roles" => [...$request->request]["role"],
                "password" => $request->request->get("password"),
                "thename" => $request->request->get("thename"),
                "thesurname" => $request->request->get("thesurname"),
                "themail" => $request->request->get("themail"),
                "thestatus" => $request->request->get("thestatus")
            ];
            $user->setUsername($tableau['username']);
            $user->setRoles($tableau['roles']);
            $user->setPassword($tableau['password']);
            $user->setThename($tableau['thename']);
            $user->setThesurname($tableau['thesurname']);
            $user->setThemail($tableau['themail']);
            $user->setThestatus((int)$tableau['thestatus']);
            die(var_dump($user));
        }
        return $this->render('admin/CRUDs/Create/formUser.html.twig');
    }

    #[Route('/admin/read/users', name: 'app_admin_read_users')]
    public function readUsers(UserRepository $repository): Response
    {
        return $this->render('admin/CRUDs/Read/entities/Users/users.twig', [
            "users" => $repository->findAllUsersByRole(),
        ]);
    }

    #[Route('/admin/update/user/{username}', name: 'app_admin_update_user')]
    public function updateUsers(UserRepository $repository, string $username = ""): Response
    {
        return $this->render('admin/admin.homepage.html.twig');
    }

    #[Route('/admin/delete/users', name: 'app_admin_delete_users')]
    public function deleteUsers(): Response
    {
        return $this->render('admin/admin.homepage.html.twig');
    }

    #[Route('/admin/read/user/{username}', name: 'app_admin_read_user')]
    public function readUser(UserRepository $repository, string $username = ""): Response
    {
        return $this->render('admin/CRUDs/Read/entities/Users/user.twig', [
            "user" => $repository->findOneByUsername($username),
        ]);
    }

    #[Route('/admin/ban/user/{username}', name: 'app_admin_ban_user')]
    public function banUser(UserRepository $repository, string $username = ""): Response
    {
        return $this->render('admin/admin.homepage.html.twig');
    }

    #[Route('/admin/update/statut/user/{username}', name: 'app_admin_update_user_statut')]
    public function updateUserStatut(UserRepository $repository, string $username = ""): Response
    {
        return $this->render('admin/admin.homepage.html.twig');
    }
}
