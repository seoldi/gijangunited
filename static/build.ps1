# gijangunited static demo builder
# Run: .\build.ps1
# _header.html / _footer.html 을 각 페이지에 인라인 삽입
# 결과: fetch() 없이 file:// 및 GitHub Pages 양쪽에서 동작

$dir    = $PSScriptRoot
$header = [System.IO.File]::ReadAllText("$dir\_header.html", [System.Text.Encoding]::UTF8).Trim()
$footer = [System.IO.File]::ReadAllText("$dir\_footer.html", [System.Text.Encoding]::UTF8).Trim()

$files = Get-ChildItem "$dir\*.html" | Where-Object { $_.Name -notmatch '^_' }

foreach ($file in $files) {
    $raw = [System.IO.File]::ReadAllText($file.FullName, [System.Text.Encoding]::UTF8)

    $out = $raw `
        -replace '<div id="_gnb"></div>', $header `
        -replace '<div id="_ftr"></div>', $footer `
        -replace '<script src="_inc\.js"></script>\r?\n?', ''

    [System.IO.File]::WriteAllText($file.FullName, $out, [System.Text.Encoding]::UTF8)
    Write-Host "OK: $($file.Name)"
}

Write-Host "`nBuild complete. $($files.Count) pages updated."
