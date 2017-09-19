<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Faker extends MY_Controller {

	function __construct()
    {
        parent::__construct();
 		
        // initiate faker
        $this->faker = Faker\Factory::create();

 		// Load faker_model
 		$this->load->model('Faker_model');
        
        //Limits
        $this->groups_limit = 2;
        $this->users_limit = 10;
    }
 	
    /**
     * [index description]
     * @return [type] [description]
     */
    public function index()
    {
    
        //Add the table name and limit as a key-value pairs in tables array
        $tables = array(
                        'groups'       => $this->groups_limit,
                        'users'        => $this->users_limit,
                        'users_groups' => $this->users_limit,
                    );


        if(count($tables)) {
            foreach ($tables as $key => $value) {
                if($this->seedingValues($key, $value)){
                    echo "$value no.of row(s) has created successfully in the table $key\n";
                } else {
                    echo "Error on creating $value row(s) in the table $key\n";
                }
            }
        }
    }
 
    /**
     * seedingValues - Function used to seeding the faker data in the given table 
     * @param  string $table Name of the table
     * @param  int $limit limit
     * @return [type]        [description]
     */
    public function seedingValues($table, $limit)
    {
        try{

            $return = false;

            // create a values based on the given limit.
            for ($i = 0; $i < $limit; $i++) {
                
                //Generates the faker data to be inserted.
                $insertdata = $this->insertData($table);

                //Insert the fake data.
                $return = $this->Faker_model->insert($table, $insertdata);
            }

            return $return;
        }

        //catch exception
        catch(Exception $e) {
          echo 'Message: ' .$e->getMessage();
        }
    }


    /**
     * insertData - Function generate the  faker data based on given limits.
     * @param  string $table Name of the table
     * @return Mixed         Return array of faker data to be inserted if it is true, otherwise prints error message.
     */
    public function insertData($table='')
    {
        switch ($table) {


            case 'groups':      return array(
                                    'name'         => $this->faker->tld,
                                    'description'  => $this->faker->sentence($nbWords = 6, $variableNbWords = true),
                                );break;

            case 'users':       return array(
                                    'ip_address'  => $this->faker->localIpv4,
                                    'username'    => $this->faker->userName,
                                    'password'    => $this->faker->safeEmail,
                                    'email'       => $this->faker->password,
                                    'created_at'  => $this->faker->unixTime($max = 'now'),
                                    'active'      => rand(0, 1)   
                                 );break;

            case 'users_groups': return array(
                                    'users_groups' => $this->faker->unique()->biasedNumberBetween($min = 1, $max = $this->users_limit),
                                    'group_id'     => $this->faker->unique()->biasedNumberBetween($min = 1, $max = $this->groups_limit)
                                );break;

            default:
                    echo "Error on seeding";break;

        }
    }
}

/* End of file Faker.php */
/* Location: ./application/controllers/Faker.php */