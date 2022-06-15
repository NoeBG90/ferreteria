<?php

session_start();

unset($_SESSION["operacion"]['tabla']);
unset($_SESSION["operacion"]['productos']);

print_r(
    "
    <tr class='text-center'>
      <th colspan='8'>No hay productos agregados</th>
    </tr>
  "
);
