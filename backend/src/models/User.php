class User {
    private $id;
    private $name;
    private $email;
    private $password;

    public function __construct($name, $email, $password) {
        $this->name = $name;
        $this->email = $email;
        $this->password = password_hash($password, PASSWORD_DEFAULT);
    }

    public function getId() {
        return $this->id;
    }

    public function getName() {
        return $this->name;
    }

    public function getEmail() {
        return $this->email;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function verifyPassword($password) {
        return password_verify($password, $this->password);
    }

    public function save() {
        // Aquí se implementaría la lógica para guardar el usuario en la base de datos
    }

    public static function findByEmail($email) {
        // Aquí se implementaría la lógica para encontrar un usuario por su email
    }
}