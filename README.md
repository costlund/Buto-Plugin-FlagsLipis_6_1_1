# Buto-Plugin-FlagsLipis_6_1_1
Show flags with svg via a widget.

## Widget
```
type: widget
data:
  plugin: flags/lipis_6_1_1
  method: flag
  data:
    flag: se
```

## Source
```
https://github.com/lipis/flag-icons
```

## Development
Page page_create_flag has to be run by webmaster to build file flags.yml.
Create one file of all flags.
http://localhost/?webmaster_plugin=flags/lipis_6_1_1&page=create_file

After this replace content.
```
Remove \n. 
Replace \" with ". 
Enclose content with '.
```
