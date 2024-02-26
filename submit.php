<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $phone = $_POST["phone"];
    $hiddenField = $_POST["hiddenField"];

    if (!empty($name) && !empty($phone) && !empty($hiddenField)) {
        $url = 'https://order.drcash.sh/v1/order';
        $headers = [
            'Content-Type: application/json',
            'Authorization: Bearer NWJLZGEWOWETNTGZMS00MZK4LWFIZJUTNJVMOTG0NJQXOTI3',
        ];

        $data = [
            'stream_code' => 'iu244',
            'client' => [
                'name' => $name,
                'phone' => $phone,
            ],
            'sub1' => $hiddenField
        ];

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close($ch);

        if ($response !== false) {
            header("Location: thank_you.php");
            exit;
        } else {
            echo "Ошибка при отправке заказа.";
        }
    } else {
        echo "Пожалуйста, заполните все поля формы.";
    }
} else {
    echo "Доступ запрещен.";
}
?>
