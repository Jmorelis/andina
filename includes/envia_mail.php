<?php

//include_once 'includes/conect.php';

class enviamail {

    private $db;
    private $mysqli;
    private $lastOrder;
    private $datosUsuario;

    public function __construct() {
        $this->db = Database::getInstance();
        $this->mysqli = $this->db->getConnection();
    }

    public function envio($idUsuario, $id_pedido) {
        $this->lastOrder = $this->getLastOrderUsuario($idUsuario, $id_pedido);
        $this->datosUsuario = $this->getDatosUsuario($idUsuario);
        $this->armoMail();
    }

    private function getLastOrderUsuario($idUsuario, $id_pedido) {
        $query = "select dp.cantidad as cantidad,p.nombre as producto,c.nombre as cliente , pe.comentario as comentario
        FROM Detalle_pedido dp
        INNER JOIN Pedidos pe ON dp.id_pedido = pe.id_pedido
        INNER JOIN Productos p ON dp.id_producto = p.id
        INNER JOIN Clientes c ON dp.id_cliente = c.id_cliente
        WHERE dp.id_usuario = ? AND dp.id_pedido = ?";
        if ($stmt = $this->mysqli->prepare($query)) {
            $stmt->bind_param("ii", $idUsuario, $id_pedido);
            $stmt->execute();
            $stmt->store_result();
            $stmt->bind_result($cantidad, $producto, $cliente,$comentario);

            while ($stmt->fetch()) {
                $listOrder[] = array("nombre" => $producto, "cantidad" => $cantidad, "cliente" => $cliente, "comentario" => $comentario);
            }
        }
        return $listOrder;
    }

    private function envioMailGmail($cuerpo, $destino) {

        //incluimos la clase PHPMailer
        require('./PHPMailer-master/class.phpmailer.php');
        require('./PHPMailer-master/class.smtp.php');

//instancio un objeto de la clase PHPMailer
        $mail = new PHPMailer(); // defaults to using php "mail()"
        $body = $cuerpo;
        $mail->IsSMTP();
        //$mail->SMTPDebug = 2;
        $mail->Host = "smtp.gmail.com";
        $mail->SMTPAuth = true;
        $mail->Host = "smtp.gmail.com";
        $mail->Port = 587;
        $mail->Username = "sistemawebandina@gmail.com";
        $mail->Password = "jmorelis2018";
        $mail->SMTPSecure = 'tls';
        $mail->SetFrom('sistemawebandina@gmail.com', ' sistema andina');
        $mail->addAddress($destino);
        $mail->addCC("Ventas@pinturasandina.com","Pedidos Andina");
        $mail->Subject = 'Pedido Andina';
        //$mail->AltBody    = "To view the message, please use an HTML compatible email viewer!";
        $mail->MsgHTML($body);
        // $address = $to;
        // $mail->AddAddress($address, $name);
//envío el mensaje, comprobando si se envió correctamente
        if (!$mail->send()) {
            echo "Error al enviar el mensaje: ";
        } else {
            echo "Mensaje enviado!!";
        }
    }

    private function armoMail() {


        $asunto = "Pedido nuevo a confirmar";
        $cuerpo = ' 
                <html> 
                <head> 
                   <title>NUEVO PEDIDO DE SISTEMA WEB</title> 
                </head> 
                <body> 
                <h1>Datos del Pedido:</h1> 
                <p> 
                PRODUCTO - CANTIDAD. 
                </p>';



        //   $cuerpo = "<h3>NUEVO PEDIDO SISTEMA WEB</h3>";
        //   $cuerpo .= "<p>Datos del Pedido:</p>";
        //   $cuerpo .= "<p>PRODUCTO - CANTIDAD</p>";
        $cliente = "";
        $comentario = "";
        $fecha = date("d-m-Y");
        foreach ($this->lastOrder as $prod) {
            $cliente = $prod['cliente'];
            $comentario = $prod['comentario'];
            $cuerpo .= "<p>" . $prod['nombre'] . " - " . $prod['cantidad'] . "</p>";
        }
        $cuerpo .= "<p>Cliente: " . $cliente . "</p>";
        $cuerpo .= "<p>Fecha Pedido: " . $fecha . "</p>";
        $cuerpo .= "<p>Comentario: " . $comentario . "</p>";

        $cuerpo .= ' 
                </body> 
                </html> 
                ';
        //$mail = "'" . $this->datosUsuario . "'";
        $headers = "MIME-Version: 1.0\r\n";
        $headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
        $headers .= "From: Sistema Web Andina <sistemawebandina@gmail.com>\r\n";

         $destino = $this->datosUsuario;
         $this->envioMailGmail($cuerpo, $destino);
       /*     
        if ($this->datosUsuario == 'jmorelis@gmail.com') {
            $destino = $this->datosUsuario;
            $this->envioMailGmail($cuerpo, $destino);
            exit();
        }
        
        */
        // mail($this->datosUsuario, $asunto, $cuerpo, $headers);
        // mail($this->datosUsuario, $asunto, $cuerpo . "</br>", "MIME-Version: 1.0\nContent-type: text/html; charset=UTF-8\nFrom:Andina");
    }

    private function getDatosUsuario($idUsuario) {
        $query = "Select email FROM Usuarios Where id = ?";
        if ($stmt = $this->mysqli->prepare($query)) {
            $stmt->bind_param("i", $idUsuario);
            $stmt->execute();
            $stmt->store_result();
            $stmt->bind_result($mail);

            while ($stmt->fetch()) {
                $datosUsuario = $mail;
            }
        }
        return $datosUsuario;
    }

}

?>