<?php

echo '<script type="text/javascript" src="../VIEW/js/jsExo5.js"></script>';

echo '<div>
        <h1>Paragraph</h1>
        <p class="ParagraphStyle_0">
          Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque elit arcu, tempor id ante eget, auctor vulputate justo. Phasellus nec lacus et tellus pretium pharetra id vitae orci. Integer non efficitur tellus, sed pretium enim. Aliquam non posuere elit, sit amet elementum urna. Etiam ultrices velit augue, eget ultrices metus dignissim vitae. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Suspendisse efficitur a erat nec mattis. Sed blandit imperdiet tortor, nec laoreet nibh commodo ac. Phasellus vitae mauris id tellus dictum pretium nec sed ipsum. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos.
        </p>
        <p class="ParagraphStyle_0">
          Etiam tempus, velit id tempor sollicitudin, enim ex gravida augue, sit amet luctus mauris erat et velit. Cras malesuada eu urna nec lobortis. Praesent sagittis purus nec libero auctor, vel scelerisque nibh ornare. Mauris lorem purus, posuere eu ultricies a, facilisis at lacus. Proin sollicitudin sapien id libero aliquam, eget laoreet diam molestie. Donec dui elit, accumsan a sodales vel, suscipit placerat velit. Nullam enim urna, venenatis id dignissim a, vehicula eu leo. Aenean dignissim, nisl elementum porttitor finibus, eros tellus finibus enim, eget malesuada lectus sem id urna. Proin vitae dolor eget est volutpat sagittis.
        </p>
        <input type="button" id="SwitchStyleInput" paramValueSwitch="0" value="White Mode"/>
      </div>';

echo '<div>
        <h1>Chrono</h1>
        <p id="ChronoOutput"></p>
        <input type="button" value="Start" id="ChronoStart"/>
        <input type="button" value="Pause" id="ChronoPause" paramInPause="false"/>
        <input type="button" value="Reset" id="ChronoReset" disabled/>
      </div>';

?>
