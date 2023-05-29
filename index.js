const folders = document.querySelectorAll('.folder');
folders.forEach(folder => {
  folder.addEventListener('click', () => {
    const folderName = folder.getAttribute('data-folder');
    const url = new URL(window.location.href);
    let queryString = window.location.search;
    let urlParams = new URLSearchParams(queryString);
    let curr_folder = urlParams.get('folder')
    if (curr_folder == null) {
      final_url = folderName;
    } else {
      let folder_depth = curr_folder.split('/');
      folder_depth.push(folderName);
      final_url = folder_depth.join('/');
    }
    url.searchParams.set('folder', final_url);
    window.location.href = url.toString();
  });
});

