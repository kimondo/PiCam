<?php
function createGallery( $pathToImages, $pathToThumbs )
{
  echo "Creating gallery.html <br />";

  $output = "<html>";
  $output .= "<head><title>Thumbnails</title></head>";
  $output .= "<body>";
  $output .= "<table cellspacing=\"0\" cellpadding=\"2\" width=\"500\">";
  $output .= "<tr>";

  // open the directory
  $dir = opendir( $pathToThumbs );

  $counter = 0;
  // loop through the directory
  while (false !== ($fname = readdir($dir)))
  {
    // strip the . and .. entries out
    if ($fname != '.' && $fname != '..')
    {
      $output .= "<td valign=\"middle\" align=\"center\"><a href=\"{$pathToImages}{$fname}\">";
      $output .= "<img src=\"{$pathToThumbs}{$fname}\" border=\"0\" />";
      $output .= "</a></td>";

      $counter += 1;
      if ( $counter % 4 == 0 ) { $output .= "</tr><tr>"; }
    }
  }
  // close the directory
  closedir( $dir );

  $output .= "</tr>";
  $output .= "</table>";
  $output .= "</body>";
  $output .= "</html>";

  // open the file
  $fhandle = fopen( "gallery.html", "w" );
  // write the contents of the $output variable to the file
  fwrite( $fhandle, $output );
  // close the file
  fclose( $fhandle );
}
// call createGallery function and pass to it as parameters the path
// to the directory that contains images and the path to the directory
// in which thumbnails will be placed. We are assuming that
// the path will be a relative path working
// both in the filesystem, and through the web for links
createGallery("upload/","upload/thumbs/");
?>