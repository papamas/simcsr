<?php
class Admin_products extends CI_Controller {
 
    /**
    * Responsable for auto load the model
    * @return void
    */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('products_model');
        $this->load->model('manufacturers_model');

        if(!$this->session->userdata('is_logged_in')){
            redirect('admin/login');
        }
    }
 
    /**
    * Load the main view with all the current model model's data.
    * @return void
    */
    public function index()
    {      
       $this->load->view('includes/header');
       $this->load->view('frontpage');
       $this->load->view('includes/footer');

    }//index

    public function add()
    {
        //if save button was clicked, get the data sent via post
        if ($this->input->server('REQUEST_METHOD') === 'POST')
        {

            //form validation
            $this->form_validation->set_rules('description', 'description', 'required');
            $this->form_validation->set_rules('stock', 'stock', 'required|numeric');
            $this->form_validation->set_rules('cost_price', 'cost_price', 'required|numeric');
            $this->form_validation->set_rules('sell_price', 'sell_price', 'required|numeric');
            $this->form_validation->set_rules('manufacture_id', 'manufacture_id', 'required');
            $this->form_validation->set_error_delimiters('<div class="alert alert-error"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');

            //if the form has passed through the validation
            if ($this->form_validation->run())
            {
                $data_to_store = array(
                    'description' => $this->input->post('description'),
                    'stock' => $this->input->post('stock'),
                    'cost_price' => $this->input->post('cost_price'),
                    'sell_price' => $this->input->post('sell_price'),          
                    'manufacture_id' => $this->input->post('manufacture_id')
                );
                //if the insert has returned true then we show the flash message
                if($this->products_model->store_product($data_to_store)){
                    $data['flash_message'] = TRUE; 
                }else{
                    $data['flash_message'] = FALSE; 
                }

            }

        }
        //fetch manufactures data to populate the select field
        $data['manufactures'] = $this->manufacturers_model->get_manufacturers();
        //load the view
        $data['main_content'] = 'admin/products/add';
        $this->load->view('includes/template', $data);  
    }       

    /**
    * Update item by his id
    * @return void
    */
    public function update()
    {
        //product id 
        $id = $this->uri->segment(4);
  
        //if save button was clicked, get the data sent via post
        if ($this->input->server('REQUEST_METHOD') === 'POST')
        {
            //form validation
            $this->form_validation->set_rules('description', 'description', 'required');
            $this->form_validation->set_rules('stock', 'stock', 'required|numeric');
            $this->form_validation->set_rules('cost_price', 'cost_price', 'required|numeric');
            $this->form_validation->set_rules('sell_price', 'sell_price', 'required|numeric');
            $this->form_validation->set_rules('manufacture_id', 'manufacture_id', 'required');
            $this->form_validation->set_error_delimiters('<div class="alert alert-error"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');
            //if the form has passed through the validation
            if ($this->form_validation->run())
            {
    
                $data_to_store = array(
                    'description' => $this->input->post('description'),
                    'stock' => $this->input->post('stock'),
                    'cost_price' => $this->input->post('cost_price'),
                    'sell_price' => $this->input->post('sell_price'),          
                    'manufacture_id' => $this->input->post('manufacture_id')
                );
                //if the insert has returned true then we show the flash message
                if($this->products_model->update_product($id, $data_to_store) == TRUE){
                    $this->session->set_flashdata('flash_message', 'updated');
                }else{
                    $this->session->set_flashdata('flash_message', 'not_updated');
                }
                redirect('admin/products/update/'.$id.'');

            }//validation run

        }

        //if we are updating, and the data did not pass trough the validation
        //the code below wel reload the current data

        //product data 
        $data['product'] = $this->products_model->get_product_by_id($id);
        //fetch manufactures data to populate the select field
        $data['manufactures'] = $this->manufacturers_model->get_manufacturers();
        //load the view
        $data['main_content'] = 'admin/products/edit';
        $this->load->view('includes/template', $data);            

    }//update

    /**
    * Delete product by his id
    * @return void
    */
    public function delete()
    {
        //product id 
        $id = $this->uri->segment(4);
        $this->products_model->delete_product($id);
        redirect('admin/products');
    }//edit

}