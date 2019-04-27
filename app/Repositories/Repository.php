<?php
    namespace App\Repositories;
    use Illuminate\Database\Eloquent\Model;

    class Repository implements RepositoryInterface{
        /**
         * @var
         */
        protected $model;

        /**
         * @param Model $model
         */
        public function __construct(Model $model){
            $this->model = $model;
        }

        /**
         *
         */
        public function all(){
            return $this->model->all();
        }

        /**
         * @param array $data
         * @return mixed
         */
        public function create(array $data){
            return $this->model->create($data);
        }

        /**
         * @param array $data
         * @param $id
         * @return mixed
         */
        public function update(array $data, $id){
            return $this->model->create($data);
        }

        /**
         * @param $id
         * @return mixed
         */
        public function delete($id){
            return $this->model->destroy($id);
        }

        /**
         * @param $id
         * @return mixed
         */
        public function show($id){
            return $this->model->findOrFail($id);
        }

        /**
         * @return mixed
         */
        public function getModel()
        {
            return $this->model;
        }

        /**
         * @param $model
         * @return $this
         */
        public function setModel($model)
        {
            $this->model = $model;
            return $this;
        }

        public function with($relations)
        {
            return $this->model->with($relations);
        }
    }
?>