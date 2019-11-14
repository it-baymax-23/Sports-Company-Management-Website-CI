<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require('vendor/autoload.php');

class BackendController extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('paypal_lib');
		$this->load->model('User_model');
		$this->load->model('Manage_model');
	}

	public function index()
	{
		$this->check_login();

		$user_id = $this->session->userdata('user_id');
		$user_name = $this->session->userdata('user_name');
		$data['menu'] = 'index';

		if ($user_id && $user_name)
		{
			$data['user'] = $this->User_model->get_user_by_id($user_id);
			$data['user_id'] = $user_id;
			$data['user_name'] = $user_name;
			$data['schedules'] = $this->Manage_model->get_all_schedule();
			$data['announces'] = $this->Manage_model->get_latest_announcement();
			$data['teams'] = $this->Manage_model->get_all_team();

			$main_players = $this->User_model->get_main_player();

			$maindata = array("GK"=>array(),"Defense"=>array(),"Middle"=>array(),"Striker"=>array());

			foreach($main_players as $key => $value)
			{
				array_push($maindata[$value['player_position']],$value);
			}
			
			$data['main_players'] = $maindata;

			$sub_players = $this->User_model->get_sub_player();

			$subdata = array("GK"=>array(),"Defense"=>array(),"Middle"=>array(),"Striker"=>array());

			foreach($sub_players as $key => $value)
			{
				array_push($subdata[$value['player_position']],$value);
			}
			
			$data['sub_players'] = $subdata;
			$data['mails'] = $this->Manage_model->get_new_mail($user_id);
			if ($data['user'][0]['user_group'] != 4)
			{
				$data['pendings'] = count($this->Manage_model->get_pending_status(0));
			} else {
				$data['pendings'] = count($this->Manage_model->get_unpaid_by_id($user_id));
			}
		}
		else
		{
			$data['user'] = '';
			$data['user_id'] = '';
			$data['user_name'] = '';
			$data['schedules'] = '';
			$data['announces'] = '';
			$data['teams'] = '';
			$data['main_players'] = '';
			$data['sub_players'] = '';
			$data['mails'] = '';
			$data['pendings'] = '';
		}
		$this->load->view('backend/header', $data);
		$this->load->view('backend/index');
		$this->load->view('backend/footer');
	}

	// User manage

	public function profile_photo_upload()
	{
		$config['upload_path']          = 'assets/uploads/user';

		if (!is_dir($config['upload_path']))
		{
			mkdir($config['upload_path'],0777,TRUE);
		}

        $config['allowed_types']        = 'gif|jpg|png';
        $config['max_size']             = 2000;
        $config['max_width']            = 1024;
        $config['max_height']           = 768;
        $this->load->library('upload', $config);

        if ( ! $this->upload->do_upload('photo'))
        {
        	echo json_encode(array('success'=>false,'message'=>$this->upload->display_errors())); 
        }
        else
        {
            $result =  array('filename'=>$config['upload_path'].'/' . $this->upload->data()['file_name']);

           echo json_encode($result);
        }
	}

	public function profile()
	{
		$this->check_login();

		$user_id = $this->session->userdata('user_id');
		$user_name = $this->session->userdata('user_name');

		$data['menu'] = 'profile';

		if ($user_id && $user_name)
		{
			$data['user'] = $this->User_model->get_user_by_id($user_id);
			$data['user_id'] = $user_id;
			$data['user_name'] = $user_name;
			$data['user_groups'] = $this->User_model->get_all_usergroup();
		}
		else
		{
			$data['user'] = '';
			$data['user_id'] = '';
			$data['user_name'] = '';
			$data['user_groups'] = '';
		}
		$this->load->view('backend/header', $data);
		$this->load->view('backend/profile');
		$this->load->view('backend/footer');
	}

	public function update_profile()
	{
		$id = $this->session->userdata('user_id');
		$user = $this->input->post();
		$message = $this->User_model->update_profile($id,$user);
		echo json_encode($message);
	}

	public function users()
	{
		$this->check_login();

		$user_id = $this->session->userdata('user_id');
		$user_name = $this->session->userdata('user_name');
		$data['menu'] = 'users';

		if ($user_id && $user_name)
		{
			$data['user'] = $this->User_model->get_user_by_id($user_id);
			$data['user_id'] = $user_id;
			$data['user_name'] = $user_name;
			$data['users'] = $this->User_model->get_all_user();
			$data['user_groups'] = $this->User_model->get_all_usergroup();
		}
		else
		{
			$data['user'] = '';
			$data['user_id'] = '';
			$data['user_name'] = '';
			$data['users'] = '';
			$data['user_groups'] = '';
		}
		$this->load->view('backend/header', $data);
		$this->load->view('backend/user-all');
		$this->load->view('backend/footer');
	}

	public function add_user()
	{
		$this->check_login();

		$user_id = $this->session->userdata('user_id');
		$user_name = $this->session->userdata('user_name');
		$data['menu'] = 'user-add';

		if ($user_id && $user_name)
		{
			$data['user'] = $this->User_model->get_user_by_id($user_id);
			$data['user_id'] = $user_id;
			$data['user_name'] = $user_name;
			$data['user_groups'] = $this->User_model->get_all_usergroup();
		}
		else
		{
			$data['user'] = '';
			$data['user_id'] = '';
			$data['user_name'] = '';
			$data['user_groups'] = '';
		}
		$this->load->view('backend/header', $data);
		$this->load->view('backend/user-add');
		$this->load->view('backend/footer');
	}

	public function edit_user($id = null)
	{
		$this->check_login();

		$user_id = $this->session->userdata('user_id');
		$user_name = $this->session->userdata('user_name');
		$data['menu'] = 'user-edit';

		if ($user_id && $user_name)
		{
			$data['user'] = $this->User_model->get_user_by_id($user_id);
			$data['user_id'] = $user_id;
			$data['user_name'] = $user_name;
			$data['edit_user'] = $this->User_model->get_user_by_id($id);
			$data['user_groups'] = $this->User_model->get_all_usergroup();
		}
		else
		{
			$data['user'] = '';
			$data['user_id'] = '';
			$data['user_name'] = '';
			$data['edit_user'] = '';
			$data['user_groups'] = '';
		}
		$this->load->view('backend/header', $data);
		$this->load->view('backend/user-edit');
		$this->load->view('backend/footer');
	}

	public function create_user()
	{
		$user = $this->input->post();
		$message = $this->User_model->add_user($user);
		echo json_encode($message);
	}

	public function update_user()
	{
		$user = $this->input->post();
		$message = $this->User_model->update_user($user);
		echo json_encode($message);
	}

	public function delete_user()
	{
		$id = $this->input->post('id');
		$message = $this->User_model->delete_user($id);
		echo json_encode($message);
	}

	public function delete_all_user()
	{
		$data = $this->input->post();
		$message = $this->User_model->delete_all_user($data['data']);
		echo json_encode($message);
	}

	public function roles()
	{
		$this->check_login();

		$user_id = $this->session->userdata('user_id');
		$user_name = $this->session->userdata('user_name');
		$data['menu'] = 'roles';

		if ($user_id && $user_name)
		{
			$data['user'] = $this->User_model->get_user_by_id($user_id);
			$data['user_id'] = $user_id;
			$data['user_name'] = $user_name;
			$data['user_groups'] = $this->User_model->get_all_usergroup();
		}
		else
		{
			$data['user'] = '';
			$data['user_id'] = '';
			$data['user_name'] = '';
			$data['user_groups'] = '';
		}
		$this->load->view('backend/header', $data);
		$this->load->view('backend/user-group');
		$this->load->view('backend/footer');
	}

	public function create_role()
	{
		$role = $this->input->post();
		$message = $this->User_model->add_role($role);
		echo json_encode($message);
	}

	public function update_role()
	{
		$role = $this->input->post();
		$message = $this->User_model->update_role($role);
		echo json_encode($message);
	}

	public function delete_role()
	{
		$id = $this->input->post('id');
		$message = $this->User_model->delete_role($id);
		echo json_encode($message);
	}

	public function tncs()
	{
		$this->check_login();

		$user_id = $this->session->userdata('user_id');
		$user_name = $this->session->userdata('user_name');
		$data['menu'] = 'tncs';

		if ($user_id && $user_name)
		{
			$data['user'] = $this->User_model->get_user_by_id($user_id);
			$data['user_id'] = $user_id;
			$data['user_name'] = $user_name;
			$data['tncs'] = $this->Manage_model->get_all_tncs();
		}
		else
		{
			$data['user'] = '';
			$data['user_id'] = '';
			$data['user_name'] = '';
			$data['tncs'] = '';
		}
		$this->load->view('backend/header', $data);
		$this->load->view('backend/term-conditions');
		$this->load->view('backend/footer');
	}

	public function create_tncs()
	{
		$tncs = $this->input->post();
		$message = $this->Manage_model->add_tncs($tncs);
		echo json_encode($message);
	}

	public function update_tncs()
	{
		$tncs = $this->input->post();
		$message = $this->Manage_model->update_tncs($tncs);
		echo json_encode($message);
	}

	public function delete_tncs()
	{
		$id = $this->input->post('id');
		$message = $this->Manage_model->delete_tncs($id);
		echo json_encode($message);
	}

	public function options()
	{
		$this->check_login();

		$user_id = $this->session->userdata('user_id');
		$user_name = $this->session->userdata('user_name');
		$data['menu'] = 'options';

		if ($user_id && $user_name)
		{
			$data['user'] = $this->User_model->get_user_by_id($user_id);
			$data['user_id'] = $user_id;
			$data['user_name'] = $user_name;
			$data['player_options'] = $this->User_model->get_all_playeroption();
		}
		else
		{
			$data['user'] = '';
			$data['user_id'] = '';
			$data['user_name'] = '';
			$data['player_options'] = '';
		}
		$this->load->view('backend/header', $data);
		$this->load->view('backend/player-options');
		$this->load->view('backend/footer');
	}

	public function create_option()
	{
		$option = $this->input->post();
		$message = $this->User_model->add_option($option);
		echo json_encode($message);
	}

	public function update_option()
	{
		$option = $this->input->post();
		$message = $this->User_model->update_option($option);
		echo json_encode($message);
	}

	public function delete_option()
	{
		$id = $this->input->post('id');
		$message = $this->User_model->delete_option($id);
		echo json_encode($message);
	}

	public function staffs()
	{
		$this->check_login();

		$user_id = $this->session->userdata('user_id');
		$user_name = $this->session->userdata('user_name');
		$data['menu'] = 'staffs';

		if ($user_id && $user_name)
		{
			$data['user'] = $this->User_model->get_user_by_id($user_id);
			$data['user_id'] = $user_id;
			$data['user_name'] = $user_name;
			$data['users'] = $this->User_model->get_all_user();
			$data['user_groups'] = $this->User_model->get_all_usergroup();
		}
		else
		{
			$data['user'] = '';
			$data['user_id'] = '';
			$data['user_name'] = '';
			$data['users'] = '';
			$data['user_groups'] = '';
		}
		$this->load->view('backend/header', $data);
		$this->load->view('backend/staff-all');
		$this->load->view('backend/footer');
	}

	public function add_staff()
	{
		$this->check_login();

		$user_id = $this->session->userdata('user_id');
		$user_name = $this->session->userdata('user_name');
		$data['menu'] = 'staff-add';

		if ($user_id && $user_name)
		{
			$data['user'] = $this->User_model->get_user_by_id($user_id);
			$data['user_id'] = $user_id;
			$data['user_name'] = $user_name;
		}
		else
		{
			$data['user'] = '';
			$data['user_id'] = '';
			$data['user_name'] = '';
		}
		$this->load->view('backend/header', $data);
		$this->load->view('backend/staff-add');
		$this->load->view('backend/footer');
	}

	public function edit_staff($id = null)
	{
		$this->check_login();

		$user_id = $this->session->userdata('user_id');
		$user_name = $this->session->userdata('user_name');
		$data['menu'] = 'staff-edit';

		if ($user_id && $user_name)
		{
			$data['user'] = $this->User_model->get_user_by_id($user_id);
			$data['user_id'] = $user_id;
			$data['user_name'] = $user_name;
			$data['edit_staff'] = $this->User_model->get_user_by_id($id);
		}
		else
		{
			$data['user'] = '';
			$data['user_id'] = '';
			$data['user_name'] = '';
			$data['edit_staff'] = '';
		}
		$this->load->view('backend/header', $data);
		$this->load->view('backend/staff-edit');
		$this->load->view('backend/footer');
	}

	public function create_staff()
	{
		$staff = $this->input->post();
		$message = $this->User_model->add_staff($staff);
		echo json_encode($message);
	}

	public function update_staff()
	{
		$staff = $this->input->post();
		$message = $this->User_model->update_staff($staff);
		echo json_encode($message);
	}

	public function delete_staff()
	{
		$id = $this->input->post('id');
		$message = $this->User_model->delete_staff($id);
		echo json_encode($message);
	}

	public function delete_all_staff()
	{
		$data = $this->input->post();
		$message = $this->User_model->delete_all_staff($data['data']);
		echo json_encode($message);
	}

	// Schedule manage

	public function schedules()
	{
		$this->check_login();

		$user_id = $this->session->userdata('user_id');
		$user_name = $this->session->userdata('user_name');
		$data['menu'] = 'schedules';

		if ($user_id && $user_name)
		{
			$data['user'] = $this->User_model->get_user_by_id($user_id);
			$data['user_id'] = $user_id;
			$data['user_name'] = $user_name;
			$data['schedules'] = $this->Manage_model->get_all_schedule();
			$data['teams'] = $this->Manage_model->get_all_team();
		}
		else
		{
			$data['user'] = '';
			$data['user_id'] = '';
			$data['user_name'] = '';
			$data['schedules'] = '';
			$data['teams'] = '';
		}
		$this->load->view('backend/header', $data);
		$this->load->view('backend/schedules');
		$this->load->view('backend/footer');
	}

	// public function add_schedule()
	// {
	// 	$this->check_login();

	// 	$user_id = $this->session->userdata('user_id');
	// 	$user_name = $this->session->userdata('user_name');
	// 	$data['menu'] = 'schedule-add';

	// 	if ($user_id && $user_name)
	// 	{
	// 		$data['user'] = $this->User_model->get_user_by_id($user_id);
	// 		$data['user_id'] = $user_id;
	// 		$data['user_name'] = $user_name;
	// 	}
	// 	else
	// 	{
	// 		$data['user'] = '';
	// 		$data['user_id'] = '';
	// 		$data['user_name'] = '';
	// 	}
	// 	$this->load->view('backend/header', $data);
	// 	$this->load->view('backend/schedule-add');
	// 	$this->load->view('backend/footer');
	// }

	// public function edit_schedule($id = null)
	// {
	// 	$this->check_login();

	// 	$user_id = $this->session->userdata('user_id');
	// 	$user_name = $this->session->userdata('user_name');
	// 	$data['menu'] = 'schedule-edit';

	// 	if ($user_id && $user_name)
	// 	{
	// 		$data['user'] = $this->User_model->get_user_by_id($user_id);
	// 		$data['user_id'] = $user_id;
	// 		$data['user_name'] = $user_name;
	// 		$data['edit_schedule'] = $this->Manage_model->get_schedule_by_id($id);
	// 	}
	// 	else
	// 	{
	// 		$data['user'] = '';
	// 		$data['user_id'] = '';
	// 		$data['user_name'] = '';
	// 		$data['edit_schedule'] = '';
	// 	}
	// 	$this->load->view('backend/header', $data);
	// 	$this->load->view('backend/schedule-edit');
	// 	$this->load->view('backend/footer');
	// }

	public function create_schedule()
	{
		$schedule = $this->input->post();
		$message = $this->Manage_model->add_schedule($schedule);
		echo json_encode($message);
	}

	public function update_schedule()
	{
		$schedule = $this->input->post();
		$message = $this->Manage_model->update_schedule($schedule);
		echo json_encode($message);
	}

	public function delete_schedule()
	{
		$id = $this->input->post('id');
		$message = $this->Manage_model->delete_schedule($id);
		echo json_encode($message);
	}

	// Update Roster

	public function players()
	{
		$this->check_login();

		$user_id = $this->session->userdata('user_id');
		$user_name = $this->session->userdata('user_name');
		$data['menu'] = 'players';

		if ($user_id && $user_name)
		{
			$data['user'] = $this->User_model->get_user_by_id($user_id);
			$data['user_id'] = $user_id;
			$data['user_name'] = $user_name;
			$data['players'] = $this->User_model->get_all_player();
		}
		else
		{
			$data['user'] = '';
			$data['user_id'] = '';
			$data['user_name'] = '';
			$data['players'] = '';
		}
		$this->load->view('backend/header', $data);
		$this->load->view('backend/players');
		$this->load->view('backend/footer');
	}

	public function update_player()
	{
		$player = $this->input->post();
		$message = $this->User_model->update_player($player);
		echo json_encode($message);
	}

	public function team_logo_upload()
	{
		$config['upload_path']          = 'assets/uploads/team-logo';

		if (!is_dir($config['upload_path']))
		{
			mkdir($config['upload_path'],0777,TRUE);
		}

        $config['allowed_types']        = 'gif|jpg|png';
        $config['max_size']             = 2000;
        $config['max_width']            = 1024;
        $config['max_height']           = 768;
        $this->load->library('upload', $config);

        if ( ! $this->upload->do_upload('photo'))
        {
        	echo json_encode(array('success'=>false,'message'=>$this->upload->display_errors())); 
        }
        else
        {
            $result =  array('filename'=>$config['upload_path'].'/' . $this->upload->data()['file_name']);

           echo json_encode($result);
        }
	}

	// Team manage

	public function teams()
	{
		$this->check_login();

		$user_id = $this->session->userdata('user_id');
		$user_name = $this->session->userdata('user_name');
		$data['menu'] = 'teams';

		if ($user_id && $user_name)
		{
			$data['user'] = $this->User_model->get_user_by_id($user_id);
			$data['user_id'] = $user_id;
			$data['user_name'] = $user_name;
			$data['teams'] = $this->Manage_model->get_all_team();
		}
		else
		{
			$data['user'] = '';
			$data['user_id'] = '';
			$data['user_name'] = '';
			$data['teams'] = '';
		}
		$this->load->view('backend/header', $data);
		$this->load->view('backend/teams');
		$this->load->view('backend/footer');
	}

	public function create_team()
	{
		$team = $this->input->post();
		$message = $this->Manage_model->add_team($team);
		echo json_encode($message);
	}

	public function update_team()
	{
		$team = $this->input->post();
		$message = $this->Manage_model->update_team($team);
		echo json_encode($message);
	}

	public function delete_team()
	{
		$id = $this->input->post('id');
		$message = $this->Manage_model->delete_team($id);
		echo json_encode($message);
	}

	// Homepage manage

	public function slider_image_upload()
	{
		$config['upload_path']          = 'assets/uploads/slider-image';

		if (!is_dir($config['upload_path']))
		{
			mkdir($config['upload_path'],0777,TRUE);
		}

        $config['allowed_types']        = 'gif|jpg|png';
        $config['max_size']             = 8000;
        $config['max_width']            = 3024;
        $config['max_height']           = 1768;
        $this->load->library('upload', $config);

        if ( ! $this->upload->do_upload('photo'))
        {
        	echo json_encode(array('success'=>false,'message'=>$this->upload->display_errors())); 
        }
        else
        {
            $result =  array('filename'=>$config['upload_path'] . '/' . $this->upload->data()['file_name']);

           echo json_encode($result);
        }
	}

	public function slider_manage()
	{
		$this->check_login();

		$user_id = $this->session->userdata('user_id');
		$user_name = $this->session->userdata('user_name');
		$data['menu'] = 'slider-manage';

		if ($user_id && $user_name)
		{
			$data['user'] = $this->User_model->get_user_by_id($user_id);
			$data['user_id'] = $user_id;
			$data['user_name'] = $user_name;
			$data['sliders'] = $this->Manage_model->get_all_slider();
		}
		else
		{
			$data['user'] = '';
			$data['user_id'] = '';
			$data['user_name'] = '';
			$data['slider'] = '';
		}
		$this->load->view('backend/header', $data);
		$this->load->view('backend/slider-all');
		$this->load->view('backend/footer');
	}

	public function add_slider()
	{
		$this->check_login();

		$user_id = $this->session->userdata('user_id');
		$user_name = $this->session->userdata('user_name');
		$data['menu'] = 'slider-add';

		if ($user_id && $user_name)
		{
			$data['user'] = $this->User_model->get_user_by_id($user_id);
			$data['user_id'] = $user_id;
			$data['user_name'] = $user_name;
		}
		else
		{
			$data['user'] = '';
			$data['user_id'] = '';
			$data['user_name'] = '';
		}
		$this->load->view('backend/header', $data);
		$this->load->view('backend/slider-add');
		$this->load->view('backend/footer');
	}

	public function edit_slider($id = null)
	{
		$this->check_login();

		$user_id = $this->session->userdata('user_id');
		$user_name = $this->session->userdata('user_name');
		$data['menu'] = 'slider-edit';

		if ($user_id && $user_name)
		{
			$data['user'] = $this->User_model->get_user_by_id($user_id);
			$data['user_id'] = $user_id;
			$data['user_name'] = $user_name;
			$data['edit_slider'] = $this->Manage_model->get_slider_by_id($id);
		}
		else
		{
			$data['user'] = '';
			$data['user_id'] = '';
			$data['user_name'] = '';
			$data['edit_slider'] = '';
		}
		$this->load->view('backend/header', $data);
		$this->load->view('backend/slider-edit');
		$this->load->view('backend/footer');
	}

	public function create_slider()
	{
		$slider = $this->input->post();
		$message = $this->Manage_model->add_slider($slider);
		echo json_encode($message);
	}

	public function update_slider()
	{
		$slider = $this->input->post();
		$message = $this->Manage_model->update_slider($slider);
		echo json_encode($message);
	}

	public function delete_slider()
	{
		$id = $this->input->post('id');
		$message = $this->Manage_model->delete_slider($id);
		echo json_encode($message);
	}

	public function latest_result()
	{
		$this->check_login();

		$user_id = $this->session->userdata('user_id');
		$user_name = $this->session->userdata('user_name');
		$data['menu'] = 'results';

		if ($user_id && $user_name)
		{
			$data['user'] = $this->User_model->get_user_by_id($user_id);
			$data['user_id'] = $user_id;
			$data['user_name'] = $user_name;
			$data['results'] = $this->Manage_model->get_all_result();
			$data['teams'] = $this->Manage_model->get_all_team();
		}
		else
		{
			$data['user'] = '';
			$data['user_id'] = '';
			$data['user_name'] = '';
			$data['results'] = '';
			$data['teams'] = '';
		}
		$this->load->view('backend/header', $data);
		$this->load->view('backend/results');
		$this->load->view('backend/footer');
	}

	public function add_result()
	{
		$this->check_login();

		$user_id = $this->session->userdata('user_id');
		$user_name = $this->session->userdata('user_name');
		$data['menu'] = 'results';

		if ($user_id && $user_name)
		{
			$data['user'] = $this->User_model->get_user_by_id($user_id);
			$data['user_id'] = $user_id;
			$data['user_name'] = $user_name;
			$data['teams'] = $this->Manage_model->get_all_team();
		}
		else
		{
			$data['user'] = '';
			$data['user_id'] = '';
			$data['user_name'] = '';
			$data['teams'] = '';
		}
		$this->load->view('backend/header', $data);
		$this->load->view('backend/result-add');
		$this->load->view('backend/footer');
	}

	public function create_result()
	{
		$result = $this->input->post();
		$message = $this->Manage_model->add_result($result);
		echo json_encode($message);
	}

	// public function update_result()
	// {
	// 	$result = $this->input->post();
	// 	$message = $this->Manage_model->update_result($result);
	// 	echo json_encode($message);
	// }

	public function delete_result()
	{
		$id = $this->input->post('id');
		$message = $this->Manage_model->delete_result($id);
		echo json_encode($message);
	}

	public function news_logo_upload()
	{
		$config['upload_path']          = 'assets/uploads/news';

		if (!is_dir($config['upload_path']))
		{
			mkdir($config['upload_path'],0777,TRUE);
		}

        $config['allowed_types']        = 'gif|jpg|png';
        $config['max_size']             = 2000;
        $config['max_width']            = 1024;
        $config['max_height']           = 768;
        $this->load->library('upload', $config);

        if ( ! $this->upload->do_upload('photo'))
        {
        	echo json_encode(array('success'=>false,'message'=>$this->upload->display_errors())); 
        }
        else
        {
            $result =  array('filename'=>$config['upload_path'].'/' . $this->upload->data()['file_name']);

           echo json_encode($result);
        }
	}

	public function latest_news()
	{
		$this->check_login();

		$user_id = $this->session->userdata('user_id');
		$user_name = $this->session->userdata('user_name');
		$data['menu'] = 'news';

		if ($user_id && $user_name)
		{
			$data['user'] = $this->User_model->get_user_by_id($user_id);
			$data['user_id'] = $user_id;
			$data['user_name'] = $user_name;
			$data['news'] = $this->Manage_model->get_all_news();
		}
		else
		{
			$data['user'] = '';
			$data['user_id'] = '';
			$data['user_name'] = '';
			$data['news'] = '';
		}
		$this->load->view('backend/header', $data);
		$this->load->view('backend/news');
		$this->load->view('backend/footer');
	}

	public function create_news()
	{
		$news = $this->input->post();
		$message = $this->Manage_model->add_news($news);
		echo json_encode($message);
	}

	// public function update_news()
	// {
	// 	$news = $this->input->post();
	// 	$message = $this->Manage_model->update_news($news);
	// 	echo json_encode($message);
	// }

	public function delete_news()
	{
		$id = $this->input->post('id');
		$message = $this->Manage_model->delete_news($id);
		echo json_encode($message);
	}

	public function training_manage()
	{
		$this->check_login();

		$user_id = $this->session->userdata('user_id');
		$user_name = $this->session->userdata('user_name');
		$data['menu'] = 'training-manage';

		if ($user_id && $user_name)
		{
			$data['user'] = $this->User_model->get_user_by_id($user_id);
			$data['user_id'] = $user_id;
			$data['user_name'] = $user_name;
			$data['trainings'] = $this->Manage_model->get_all_training();
			// $data['teams'] = $this->Manage_model->get_all_team();
		}
		else
		{
			$data['user'] = '';
			$data['user_id'] = '';
			$data['user_name'] = '';
			$data['trainings'] = '';
		}
		$this->load->view('backend/header', $data);
		$this->load->view('backend/training-manage');
		$this->load->view('backend/footer');
	}

	public function create_training()
	{
		$training = $this->input->post();
		$message = $this->Manage_model->add_training($training);
		echo json_encode($message);
	}

	public function update_training()
	{
		$training = $this->input->post();
		$message = $this->Manage_model->update_training($training);
		echo json_encode($message);
	}

	public function delete_training()
	{
		$id = $this->input->post('id');
		$message = $this->Manage_model->delete_training($id);
		echo json_encode($message);
	}

	public function tournament_manage()
	{
		$this->check_login();

		$user_id = $this->session->userdata('user_id');
		$user_name = $this->session->userdata('user_name');
		$data['menu'] = 'tournamet-manage';

		if ($user_id && $user_name)
		{
			$data['user'] = $this->User_model->get_user_by_id($user_id);
			$data['user_id'] = $user_id;
			$data['user_name'] = $user_name;
			$data['tournaments'] = $this->Manage_model->get_all_tournament();
			// $data['teams'] = $this->Manage_model->get_all_team();
		}
		else
		{
			$data['user'] = '';
			$data['user_id'] = '';
			$data['user_name'] = '';
			$data['tournaments'] = '';
		}
		$this->load->view('backend/header', $data);
		$this->load->view('backend/tournament-manage');
		$this->load->view('backend/footer');
	}

	public function create_tournament()
	{
		$tournament = $this->input->post();
		$message = $this->Manage_model->add_tournament($tournament);
		echo json_encode($message);
	}

	public function update_tournament()
	{
		$tournament = $this->input->post();
		$message = $this->Manage_model->update_tournament($tournament);
		echo json_encode($message);
	}

	public function delete_tournament()
	{
		$id = $this->input->post('id');
		$message = $this->Manage_model->delete_tournament($id);
		echo json_encode($message);
	}

	public function standing_manage()
	{
		$this->check_login();

		$user_id = $this->session->userdata('user_id');
		$user_name = $this->session->userdata('user_name');
		$data['menu'] = 'tournamet-manage';

		if ($user_id && $user_name)
		{
			$data['user'] = $this->User_model->get_user_by_id($user_id);
			$data['user_id'] = $user_id;
			$data['user_name'] = $user_name;
			$data['schedules'] = $this->Manage_model->get_all_schedule();
			$data['teams'] = $this->Manage_model->get_all_teampoints();
		}
		else
		{
			$data['user'] = '';
			$data['user_id'] = '';
			$data['user_name'] = '';
		}
		$this->load->view('backend/header', $data);
		$this->load->view('backend/standing-manage');
		$this->load->view('backend/footer');
	}

	// Announcement manage

	public function announce_photo_upload()
	{
		$config['upload_path']          = 'assets/uploads/announce';

		if (!is_dir($config['upload_path']))
		{
			mkdir($config['upload_path'],0777,TRUE);
		}

        $config['allowed_types']        = 'gif|jpg|png';
        $config['max_size']             = 2000;
        $config['max_width']            = 1024;
        $config['max_height']           = 768;
        $this->load->library('upload', $config);

        if ( ! $this->upload->do_upload('photo'))
        {
        	echo json_encode(array('success'=>false,'message'=>$this->upload->display_errors())); 
        }
        else
        {
            $result =  array('filename'=>$config['upload_path'].'/' . $this->upload->data()['file_name']);

           echo json_encode($result);
        }
	}

	public function announces()
	{
		$this->check_login();

		$user_id = $this->session->userdata('user_id');
		$user_name = $this->session->userdata('user_name');
		$data['menu'] = 'announces';

		if ($user_id && $user_name)
		{
			$data['user'] = $this->User_model->get_user_by_id($user_id);
			$data['user_id'] = $user_id;
			$data['user_name'] = $user_name;
			$data['announces'] = $this->Manage_model->get_all_announcement();
		}
		else
		{
			$data['user'] = '';
			$data['user_id'] = '';
			$data['user_name'] = '';
			$data['announces'] = '';
		}
		$this->load->view('backend/header', $data);
		$this->load->view('backend/announces');
		$this->load->view('backend/footer');
	}

	public function create_announce()
	{
		$announce = $this->input->post();
		$message = $this->Manage_model->add_announcement($announce);
		echo json_encode($message);
	}

	public function update_announce()
	{
		$announce = $this->input->post();
		$message = $this->Manage_model->update_announcement($announce);
		echo json_encode($message);
	}

	public function delete_announce()
	{
		$id = $this->input->post('id');
		$message = $this->Manage_model->delete_announcement($id);
		echo json_encode($message);
	}

	// Message manage

	public function show_mail($id = null)
	{
		$this->check_login();

		$user_id = $this->session->userdata('user_id');
		$user_name = $this->session->userdata('user_name');
		$data['menu'] = 'show_mail';

		if ($user_id && $user_name)
		{
			$data['user'] = $this->User_model->get_user_by_id($user_id);
			$data['user_id'] = $user_id;
			$data['user_name'] = $user_name;
			if ($data['user'][0]['user_group'] == 4) {
				$data['users'] = $this->User_model->get_admin_coach();
			} elseif ($data['user'][0]['user_group'] == 3) {
				$data['users'] = $this->User_model->get_admin_coach();
			} else {
				$data['users'] = $this->User_model->get_all_user();
			}
			$data['mail'] = $this->Manage_model->get_mail_by_id($id);
		}
		else
		{
			$data['user'] = '';
			$data['user_id'] = '';
			$data['user_name'] = '';
		}

		$this->load->view('backend/header', $data);
		$this->load->view('backend/mail-show');
		$this->load->view('backend/footer');
	}

	public function inbox_mail()
	{
		$this->check_login();

		$user_id = $this->session->userdata('user_id');
		$user_name = $this->session->userdata('user_name');
		$data['menu'] = 'inbox';

		if ($user_id && $user_name)
		{
			$data['user'] = $this->User_model->get_user_by_id($user_id);
			$data['user_id'] = $user_id;
			$data['user_name'] = $user_name;
			if ($data['user'][0]['user_group'] == 4) {
				$data['users'] = $this->User_model->get_admin_coach();
			} elseif ($data['user'][0]['user_group'] == 3) {
				$data['users'] = $this->User_model->get_admin_coach();
			} else {
				$data['users'] = $this->User_model->get_all_user();
			}
			$data['mails'] = $this->Manage_model->get_to_mail($user_id);
		}
		else
		{
			$data['user'] = '';
			$data['user_id'] = '';
			$data['user_name'] = '';
		}

		$this->load->view('backend/header', $data);
		$this->load->view('backend/mail-inbox');
		$this->load->view('backend/footer');
	}

	public function outbox_mail()
	{
		$this->check_login();

		$user_id = $this->session->userdata('user_id');
		$user_name = $this->session->userdata('user_name');
		$data['menu'] = 'outbox';

		if ($user_id && $user_name)
		{
			$data['user'] = $this->User_model->get_user_by_id($user_id);
			$data['user_id'] = $user_id;
			$data['user_name'] = $user_name;
			if ($data['user'][0]['user_group'] == 4) {
				$data['users'] = $this->User_model->get_admin_coach();
			} elseif ($data['user'][0]['user_group'] == 3) {
				$data['users'] = $this->User_model->get_admin_coach();
			} else {
				$data['users'] = $this->User_model->get_all_user();
			}
			$data['mails'] = $this->Manage_model->get_from_mail($user_id);
		}
		else
		{
			$data['user'] = '';
			$data['user_id'] = '';
			$data['user_name'] = '';
		}

		$this->load->view('backend/header', $data);
		$this->load->view('backend/mail-outbox');
		$this->load->view('backend/footer');
	}

	public function send_mail()
	{
		$mail = $this->input->post();
		$message = $this->Manage_model->send_mail($mail);
		echo json_encode($message);
	}

	// public function update_mail()
	// {
	// 	$mail = $this->input->post();
	// 	$message = $this->Manage_model->update_mail($mail);
	// 	echo json_encode($message);
	// }

	public function delete_mail()
	{
		$mail = $this->input->post();
		$message = $this->Manage_model->delete_mail($mail);
		echo json_encode($message);
	}

    // Shop Manage

    //---- Product Manage -----//

    public function product_image_upload()
	{
		$config['upload_path']          = 'assets/uploads/products';

		if (!is_dir($config['upload_path']))
		{
			mkdir($config['upload_path'],0777,TRUE);
		}

        $config['allowed_types']        = 'gif|jpg|png';
        $config['max_size']             = 8000;
        $config['max_width']            = 3024;
        $config['max_height']           = 1768;
        $this->load->library('upload', $config);

        if ( ! $this->upload->do_upload('photo'))
        {
        	echo json_encode(array('success'=>false,'message'=>$this->upload->display_errors())); 
        }
        else
        {
            $result =  array('filename'=>$config['upload_path'] . '/' . $this->upload->data()['file_name']);

           echo json_encode($result);
        }
	}

    public function products()
	{
		$this->check_login();

		$user_id = $this->session->userdata('user_id');
		$user_name = $this->session->userdata('user_name');
		$data['menu'] = 'products';

		if ($user_id && $user_name)
		{
			$data['user'] = $this->User_model->get_user_by_id($user_id);
			$data['user_id'] = $user_id;
			$data['user_name'] = $user_name;
			$data['products'] = $this->Manage_model->get_all_products();
		}
		else
		{
			$data['user'] = '';
			$data['user_id'] = '';
			$data['user_name'] = '';
			$data['products'] = '';
		}
		$this->load->view('backend/header', $data);
		$this->load->view('backend/products');
		$this->load->view('backend/footer');
	}

	public function add_product()
	{
		$this->check_login();

		$user_id = $this->session->userdata('user_id');
		$user_name = $this->session->userdata('user_name');
		$data['menu'] = 'product-add';

		if ($user_id && $user_name)
		{
			$data['user'] = $this->User_model->get_user_by_id($user_id);
			$data['user_id'] = $user_id;
			$data['user_name'] = $user_name;
			$data['categories'] = $this->Manage_model->get_all_categories();
			$data['sizes'] = $this->Manage_model->get_all_sizes();
			$data['colors'] = $this->Manage_model->get_all_colors();
		}
		else
		{
			$data['user'] = '';
			$data['user_id'] = '';
			$data['user_name'] = '';
		}
		$this->load->view('backend/header', $data);
		$this->load->view('backend/product-add');
		$this->load->view('backend/footer');
	}

	public function edit_product($id = null)
	{
		$this->check_login();

		$user_id = $this->session->userdata('user_id');
		$user_name = $this->session->userdata('user_name');
		$data['menu'] = 'product-edit';

		if ($user_id && $user_name)
		{
			$data['user'] = $this->User_model->get_user_by_id($user_id);
			$data['user_id'] = $user_id;
			$data['user_name'] = $user_name;
			$data['edit_product'] = $this->Manage_model->get_product_by_id($id);
			$data['categories'] = $this->Manage_model->get_all_categories();
			$data['sizes'] = $this->Manage_model->get_all_sizes();
			$data['colors'] = $this->Manage_model->get_all_colors();
		}
		else
		{
			$data['user'] = '';
			$data['user_id'] = '';
			$data['user_name'] = '';
			$data['edit_product'] = '';
		}
		$this->load->view('backend/header', $data);
		$this->load->view('backend/product-edit');
		$this->load->view('backend/footer');
	}

	public function create_product()
	{
		$product = $this->input->post();
		$message = $this->Manage_model->add_product($product);
		echo json_encode($message);
	}

	public function update_product()
	{
		$product = $this->input->post();
		$message = $this->Manage_model->update_product($product);
		echo json_encode($message);
	}

	public function delete_product()
	{
		$id = $this->input->post('id');
		$message = $this->Manage_model->delete_product($id);
		echo json_encode($message);
	}

	public function colors()
	{
		$this->check_login();

		$user_id = $this->session->userdata('user_id');
		$user_name = $this->session->userdata('user_name');
		$data['menu'] = 'colors';

		if ($user_id && $user_name)
		{
			$data['user'] = $this->User_model->get_user_by_id($user_id);
			$data['user_id'] = $user_id;
			$data['user_name'] = $user_name;
			$data['colors'] = $this->Manage_model->get_all_colors();
		}
		else
		{
			$data['user'] = '';
			$data['user_id'] = '';
			$data['user_name'] = '';
			$data['colors'] = '';
		}
		$this->load->view('backend/header', $data);
		$this->load->view('backend/colors');
		$this->load->view('backend/footer');
	}

	public function create_color()
	{
		$color = $this->input->post();
		$message = $this->Manage_model->add_color($color);
		echo json_encode($message);
	}

	public function update_color()
	{
		$color = $this->input->post();
		$message = $this->Manage_model->update_color($color);
		echo json_encode($message);
	}

	public function delete_color()
	{
		$id = $this->input->post('id');
		$message = $this->Manage_model->delete_color($id);
		echo json_encode($message);
	}

	public function sizes()
	{
		$this->check_login();

		$user_id = $this->session->userdata('user_id');
		$user_name = $this->session->userdata('user_name');
		$data['menu'] = 'sizes';

		if ($user_id && $user_name)
		{
			$data['user'] = $this->User_model->get_user_by_id($user_id);
			$data['user_id'] = $user_id;
			$data['user_name'] = $user_name;
			$data['sizes'] = $this->Manage_model->get_all_sizes();
		}
		else
		{
			$data['user'] = '';
			$data['user_id'] = '';
			$data['user_name'] = '';
			$data['sizes'] = '';
		}
		$this->load->view('backend/header', $data);
		$this->load->view('backend/sizes');
		$this->load->view('backend/footer');
	}

	public function create_size()
	{
		$size = $this->input->post();
		$message = $this->Manage_model->add_size($size);
		echo json_encode($message);
	}

	public function update_size()
	{
		$size = $this->input->post();
		$message = $this->Manage_model->update_size($size);
		echo json_encode($message);
	}

	public function delete_size()
	{
		$id = $this->input->post('id');
		$message = $this->Manage_model->delete_size($id);
		echo json_encode($message);
	}

	public function categories()
	{
		$this->check_login();

		$user_id = $this->session->userdata('user_id');
		$user_name = $this->session->userdata('user_name');
		$data['menu'] = 'categories';

		if ($user_id && $user_name)
		{
			$data['user'] = $this->User_model->get_user_by_id($user_id);
			$data['user_id'] = $user_id;
			$data['user_name'] = $user_name;
			$data['categories'] = $this->Manage_model->get_all_categories();
		}
		else
		{
			$data['user'] = '';
			$data['user_id'] = '';
			$data['user_name'] = '';
			$data['categories'] = '';
		}
		$this->load->view('backend/header', $data);
		$this->load->view('backend/product-groups');
		$this->load->view('backend/footer');
	}

	public function create_category()
	{
		$category = $this->input->post();
		$message = $this->Manage_model->add_category($category);
		echo json_encode($message);
	}

	public function update_category()
	{
		$category = $this->input->post();
		$message = $this->Manage_model->update_category($category);
		echo json_encode($message);
	}

	public function delete_category()
	{
		$id = $this->input->post('id');
		$message = $this->Manage_model->delete_category($id);
		echo json_encode($message);
	}

	public function delivery()
	{
		$this->check_login();

		$user_id = $this->session->userdata('user_id');
		$user_name = $this->session->userdata('user_name');
		$data['menu'] = 'delivery';

		if ($user_id && $user_name)
		{
			$data['user'] = $this->User_model->get_user_by_id($user_id);
			$data['user_id'] = $user_id;
			$data['user_name'] = $user_name;
			$data['deliveries'] = $this->Manage_model->get_all_delivery();
		}
		else
		{
			$data['user'] = '';
			$data['user_id'] = '';
			$data['user_name'] = '';
			$data['deliveries'] = '';
		}
		$this->load->view('backend/header', $data);
		$this->load->view('backend/delivery-options');
		$this->load->view('backend/footer');
	}

	public function create_delivery()
	{
		$delivery = $this->input->post();
		$message = $this->Manage_model->add_delivery($delivery);
		echo json_encode($message);
	}

	public function update_delivery()
	{
		$delivery = $this->input->post();
		$message = $this->Manage_model->update_delivery($delivery);
		echo json_encode($message);
	}

	public function delete_delivery()
	{
		$id = $this->input->post('id');
		$message = $this->Manage_model->delete_delivery($id);
		echo json_encode($message);
	}

	//----- Product Payment Manage -----//
	public function product_payments()
	{
		$this->check_login();

		$user_id = $this->session->userdata('user_id');
		$user_name = $this->session->userdata('user_name');
		$data['menu'] = 'product_payments';

		if ($user_id && $user_name)
		{
			$data['user'] = $this->User_model->get_user_by_id($user_id);
			$data['user_id'] = $user_id;
			$data['user_name'] = $user_name;
			$data['announces'] = $this->Manage_model->get_all_product_payments();
		}
		else
		{
			$data['user'] = '';
			$data['user_id'] = '';
			$data['user_name'] = '';
			$data['announces'] = '';
		}
		$this->load->view('backend/header', $data);
		$this->load->view('backend/product-payments');
		$this->load->view('backend/footer');
	}

	// Login & Register & Forgot Password manage

	public function login_index()
	{
		$data['player_options'] = $this->User_model->get_active_option();
		$data['tncs'] = $this->Manage_model->get_latest_tncs();
		$this->load->view('backend/login', $data);
	}

	public function login()
	{
		$user = $this->input->post();
		$message = $this->User_model->login($user);
		if (!$message['success'])
		{
			echo json_encode($message);	
		}
		else
		{
			$user_info = $message['user_info'];
			$this->load->helper('url');
			$this->session->set_userdata('user_id', $message['user_info']['id']);
			$this->session->set_userdata('user_name', $message['user_info']['username']);
			echo json_encode(array('success'=>true,'message'=>'Login Successed','redirect_url'=>base_url()));
		}
	}

	public function check_login()
	{
		if ($this->session->userdata('user_id'))
		{
			$result = $this->User_model->checkLogin($this->session->userdata('user_id'), $this->session->userdata('user_name'));

			if (!$result)
			{
				redirect('/login');
			}
		}
		else
		{
			redirect('/login');
		}
	}

	public function logout()
	{
		$this->session->sess_destroy();
		redirect(base_url());
	}

	public function register_index()
	{
		$data['player_options'] = $this->User_model->get_active_option();
		$data['tncs'] = $this->Manage_model->get_latest_tncs();
		$this->load->view('backend/register', $data);
	}

	public function register()
	{
		$user = $this->input->post();
		$message = $this->User_model->register($user);
		// echo json_encode($message);
		if (!$message['success'])
		{
			echo json_encode($message);	
		}
		else
		{
			$user_info = $message['user_info'];
			$this->load->helper('url');
			$this->session->set_userdata('user_id', $message['user_info']['id']);
			$this->session->set_userdata('user_name', $message['user_info']['username']);
			echo json_encode(array('success'=>true,'message'=>'Register Successed','redirect_url'=>base_url()));
		}
	}

	// Register Payment Manage

	public function stack()
	{
		$data = $this->input->post();
		$user = $data['data'];
		$this->session->set_userdata('user_info', $user);
		$cost = $data['cost'];
		$this->session->set_userdata('cost', $cost);
		$message['success'] = true;
		// register_pay();
		echo json_encode($message);
	}

	public function reg_paypal()
	{
		// $data['player_options'] = $this->User_model->get_active_option();
		// $data['tncs'] = $this->Manage_model->get_latest_tncs();
		$this->load->view('backend/reg-paypal');
	}

	public function register_pay()
	{
		// $data = $this->input->post();
		// $user = $data['data'];
		// $this->session->set_userdata('user_info', $user);
		$cost = $this->session->userdata('cost');
        // Set variables for paypal form
        $returnURL = base_url().'backend/register_pay_success';
        $cancelURL = base_url().'backend/register_pay_cancel';
        $notifyURL = base_url().'backend/register_pay_ipn';
        
        // Get product data from the database
        // $product = $this->product->getRows($id);

        $product['name'] = 'Register Payment';
        $product['price'] = $cost;
        
        // Get current user ID from the session
        // $userID = $this->session->userdata('user_id');
        
        // Add fields to paypal form
        $this->paypal_lib->add_field('return', $returnURL);
        $this->paypal_lib->add_field('cancel_return', $cancelURL);
        $this->paypal_lib->add_field('notify_url', $notifyURL);
        $this->paypal_lib->add_field('item_name', $product['name']);
        // $this->paypal_lib->add_field('custom', $userID);
        // $this->paypal_lib->add_field('item_number',  $product['id']);
        $this->paypal_lib->add_field('amount',  $product['price']);
        
        // Render paypal form
        $this->paypal_lib->paypal_auto_form();
    }

    function register_pay_success()
    {
        // Get the transaction data
        $paypalInfo = $this->input->get();

        // $data['item_name']      = $paypalInfo['item_name'];
        // $data['item_number']    = $paypalInfo['item_number'];
        $data['txn_id']         = $paypalInfo["tx"];
        $data['payment_amt']    = $paypalInfo["amt"];
        $data['currency_code']  = $paypalInfo["cc"];
        $data['status']         = $paypalInfo["st"];
        
        // Pass the transaction data to view
        $this->load->view('backend/reg-pay-success', $data);
    }
     
    function register_pay_cancel()
    {
        // Load payment failed view
        $this->load->view('backend/reg-pay-cancel');
    }
     
    function register_pay_ipn()
    {
        // Paypal posts the transaction data
        $paypalInfo = $this->input->post();

        $user = $this->session->userdata('user_info');
        $message = $this->User_model->register($user);
        if($message['success'])
        {
        	$user_id = $message['id'];
        	$this->session->set_userdata('user_info', '');
        	$this->session->set_userdata('cost', '');
        } else {
        	$user_id = '000';
        	$this->session->set_userdata('user_info', '');
        	$this->session->set_userdata('cost', '');
        }
        
        if (!empty($paypalInfo))
        {
            // Validate and get the ipn response
            $ipnCheck = $this->paypal_lib->validate_ipn($paypalInfo);

            // Check whether the transaction is valid
            if ($ipnCheck)
            {
                // Insert the transaction data in the database
                $data['user_id']        = $user_id;
                // $data['product_id']        = $paypalInfo["item_number"];
                $data['txn_id']         = $paypalInfo["txn_id"];
                $data['payment_gross']  = $paypalInfo["mc_gross"];
                $data['currency_code']  = $paypalInfo["mc_currency"];
                $data['payer_email']    = $paypalInfo["payer_email"];
                $data['payment_status'] = $paypalInfo["payment_status"];

                $this->Manage_model->insertTransaction($data);
            }
        }
    }

	// Pending Payment manage

	//----- Player pending manage -----//

	public function pending_payments()
	{
		$this->check_login();

		$user_id = $this->session->userdata('user_id');
		$user_name = $this->session->userdata('user_name');
		$data['menu'] = 'payments';

		if ($user_id && $user_name)
		{
			$data['user'] = $this->User_model->get_user_by_id($user_id);
			$data['user_id'] = $user_id;
			$data['user_name'] = $user_name;
			$data['statuses'] = $this->Manage_model->get_status_by_id($user_id);
			$data['fees'] = $this->Manage_model->get_all_fees();
		}
		else
		{
			$data['user'] = '';
			$data['user_id'] = '';
			$data['user_name'] = '';
		}
		$this->load->view('backend/header', $data);
		$this->load->view('backend/pending-payments');
		$this->load->view('backend/footer');
	}

	public function pay()
	{
        // Set variables for paypal form
        $returnURL = base_url().'backend/pay_success';
        $cancelURL = base_url().'backend/pay_cancel';
        $notifyURL = base_url().'backend/pay_ipn';
        
        // Get product data from the database
        // $product = $this->product->getRows($id);

        $product['name'] = 'Pay ' . $_GET["fee_name"];
        $product['id'] = $_GET["fee_id"];
        $product['price'] = $_GET["fee_cost"];
        
        // Get current user ID from the session
        $userID = $this->session->userdata('user_id');
        
        // Add fields to paypal form
        $this->paypal_lib->add_field('return', $returnURL);
        $this->paypal_lib->add_field('cancel_return', $cancelURL);
        $this->paypal_lib->add_field('notify_url', $notifyURL);
        $this->paypal_lib->add_field('item_name', $product['name']);
        $this->paypal_lib->add_field('custom', $userID);
        $this->paypal_lib->add_field('item_number',  $product['id']);
        $this->paypal_lib->add_field('amount',  $product['price']);
        
        // Render paypal form
        $this->paypal_lib->paypal_auto_form();
    }

    function pay_success()
    {
        // Get the transaction data
        $paypalInfo = $this->input->get();

        // $data['item_name']      = $paypalInfo['item_name'];
        // $data['item_number']    = $paypalInfo['item_number'];
        $data['txn_id']         = $paypalInfo["tx"];
        $data['payment_amt']    = $paypalInfo["amt"];
        $data['currency_code']  = $paypalInfo["cc"];
        $data['status']         = $paypalInfo["st"];
        
        // Pass the transaction data to view
        $this->load->view('backend/success', $data);
    }
     
    function pay_cancel()
    {
        // Load payment failed view
        $this->load->view('backend/cancel');
     }
     
    function pay_ipn()
    {
        // Paypal posts the transaction data
        $paypalInfo = $this->input->post();
        
        if (!empty($paypalInfo))
        {
            // Validate and get the ipn response
            $ipnCheck = $this->paypal_lib->validate_ipn($paypalInfo);

            // Check whether the transaction is valid
            if ($ipnCheck)
            {
                // Insert the transaction data in the database
                $data['user_id']        = $paypalInfo["custom"];
                $data['product_id']     = $paypalInfo["item_number"];
                $data['txn_id']         = $paypalInfo["txn_id"];
                $data['payment_gross']  = $paypalInfo["mc_gross"];
                $data['currency_code']  = $paypalInfo["mc_currency"];
                $data['payer_email']    = $paypalInfo["payer_email"];
                $data['payment_status'] = $paypalInfo["payment_status"];

                $this->Manage_model->insertTransaction($data);
            }
        }
    }

    //------- Admin pending status manage  --------//

	public function fees($id = null)
	{
		$this->check_login();

		$user_id = $this->session->userdata('user_id');
		$user_name = $this->session->userdata('user_name');
		$data['menu'] = 'fees';

		if ($user_id && $user_name)
		{
			$data['user'] = $this->User_model->get_user_by_id($user_id);
			$data['user_id'] = $user_id;
			$data['user_name'] = $user_name;
			$data['fees'] = $this->Manage_model->get_all_fees();

			
			// var_dump($data['players']);exit();
			if ($id != null){
				$data['fee_id'] = $id;
				$data['players'] = $this->User_model->get_inactive_all_players($id);
			} else {
				if (isset($data['fees'][0]['id'])) {
					$data['fee_id'] = $data['fees'][0]['id'];
					$data['players'] = $this->User_model->get_inactive_all_players($data['fee_id']);
				} else {
					$data['fee_id'] = null;
					$data['players'] = [];
				}
			}
		}
		else
		{
			$data['user'] = '';
			$data['user_id'] = '';
			$data['user_name'] = '';
			$data['fees'] = '';
		}
		$this->load->view('backend/header', $data);
		$this->load->view('backend/fees');
		$this->load->view('backend/footer');
	}

	public function create_fee()
	{
		$fee = $this->input->post();
		$message = $this->Manage_model->add_fee($fee);
		echo json_encode($message);
	}

	public function update_fee()
	{
		$fee = $this->input->post();
		$message = $this->Manage_model->update_fee($fee);
		echo json_encode($message);
	}

	public function delete_fee()
	{
		$id = $this->input->post('id');
		$message = $this->Manage_model->delete_fee($id);
		echo json_encode($message);
	}

	public function delete_all_fee()
	{
		$data = $this->input->post();
		$message = $this->Manage_model->delete_all_fee($data['data']);
		echo json_encode($message);
	}

	public function put_fees()
	{
		$data = $this->input->post();
		$message = $this->Manage_model->put_fee_player($data['data'], $data['fee_id']);
		echo json_encode($message);
	}

	public function pending_status()
	{
		$this->check_login();

		$user_id = $this->session->userdata('user_id');
		$user_name = $this->session->userdata('user_name');
		$data['menu'] = 'pending_status';

		if ($user_id && $user_name)
		{
			$data['user'] = $this->User_model->get_user_by_id($user_id);
			$data['user_id'] = $user_id;
			$data['user_name'] = $user_name;
			$data['statuses'] = $this->Manage_model->get_pending_status(0);
			$data['players'] = $this->User_model->get_all_player();
			$data['fees'] = $this->Manage_model->get_all_fees();
		}
		else
		{
			$data['user'] = '';
			$data['user_id'] = '';
			$data['user_name'] = '';
		}
		$this->load->view('backend/header', $data);
		$this->load->view('backend/pending-status');
		$this->load->view('backend/footer');
	}

	public function acheive()
	{
		$this->check_login();

		$user_id = $this->session->userdata('user_id');
		$user_name = $this->session->userdata('user_name');
		$data['menu'] = 'pending_status';

		if ($user_id && $user_name)
		{
			$data['user'] = $this->User_model->get_user_by_id($user_id);
			$data['user_id'] = $user_id;
			$data['user_name'] = $user_name;
			$data['statuses'] = $this->Manage_model->get_pending_status(1);
			$data['players'] = $this->User_model->get_all_player();
			$data['fees'] = $this->Manage_model->get_all_fees();
		}
		else
		{
			$data['user'] = '';
			$data['user_id'] = '';
			$data['user_name'] = '';
		}
		$this->load->view('backend/header', $data);
		$this->load->view('backend/acheive');
		$this->load->view('backend/footer');
	}

	public function delete_acheive()
	{
		$id = $this->input->post('id');
		$message = $this->Manage_model->delete_acheive($id);
		echo json_encode($message);
	}

	public function delete_all_acheive()
	{
		$data = $this->input->post();
		$message = $this->Manage_model->delete_all_acheive($data['data']);
		echo json_encode($message);
	}
	
	public function update_pay_stauts()
	{
		$id = $this->input->post('id');
		$message = $this->Manage_model->update_pay_stauts($id);
		echo json_encode($message);
	}
}
