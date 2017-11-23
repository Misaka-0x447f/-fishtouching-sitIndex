import hashlib
import time
import os
import json


class Console:
    @staticmethod
    def log(arg1):
        runtime = time.time() - script_start
        print("[" + "{:12.6f}".format(runtime) + "]" + arg1)

class term:
    color_set = {
        "header": "\033[95m",
        "okblue": "\033[94m",
        "okgreen": "\033[92m",
        "warning": "\033[93m",
        "fail": "\033[91m",
        "endc": "\033[0m",
        "bold": "\033[1m",
        "underline": "\033[4m"
    }
    @staticmethod
    def set_color(color):
        if color in term.color_set:
            print(term.color_set[color])
        else:
            print(term.color_set["warning"])
            Console.log("Warning: unexcepted color received")
            term.reset_color()
    @staticmethod
    def reset_color():
        print(term.color_set["endc"])

script_start = time.time()

Console.log("nanoLocationBook database construction toolkit")
Console.log("initializing...")

file_name = "storage.json"
Console.log("file name specified: " + file_name)
if os.path.isfile(file_name):
    Console.log("file found: " + file_name)
    file = open(file_name, "r")
    Console.log("existed content: ")
    file_content = file.read()
    file.close()
    file_content = json.loads(file_content)
    print(file_content)
else:
    Console.log("file not found, initializing file \"" + file_name + "\" with empty dict...")
    file = open(file_name, "w")
    file_content = {}
    file.write("{\n}")
    file.close()


Console.log("ready for store new data.")
term.set_color("okblue")
input("Press Enter to continue...")
term.reset_color()
while True:
    contents_input_result_duplicated = None
    while contents_input_result_duplicated is not False:
        term.set_color("okblue")
        name = input("name=")
        location = input("location=")
        comment = input("(press enter to skip)comment=")
        term.reset_color()
        if comment is "":
            push_contents = {
                "name": name,
                "location": location
            }
        else:
            push_contents = {
                "name": name,
                "location": location,
                "comment": comment
            }

        Console.log("Received content: ")
        print(push_contents)

        hashd_title = str(hashlib.sha256(name.encode("utf-8")).hexdigest())

        if hashd_title in file_content:
            contents_input_result_duplicated = True
            term.set_color("warning")
            Console.log("Warning: duplicated content detected")
            Console.log("SHA512 hash value = " + hashd_title)
            Console.log("Your input was not accepted.")
            term.reset_color()
        else:
            contents_input_result_duplicated = False

    term.set_color("okblue")
    comfirm_input_result = None
    while comfirm_input_result not in {"Y", "y", "N", "n", "C", "c", ""}:
        comfirm_input_result = input("Is it okay? (Yes/no/cancel)")
    term.reset_color()

    if comfirm_input_result in {"Y", "y", ""}:
        file_write_counter = {
            hashd_title: push_contents
        }
        file_content.update(file_write_counter)
        file_write_counter = json.dumps(file_write_counter, sort_keys=True, indent=4)

        Console.log("saving files...")
        file = open(file_name, "w")
        string_total_written_value_receiver = file.write(json.dumps(file_content, sort_keys=True, indent=4))
        file.close()
        term.set_color("okgreen")
        Console.log("Operate complete. Strings added: " + str(len(file_write_counter))
                    + ", Strings total written: " + str(string_total_written_value_receiver))
        term.reset_color()
